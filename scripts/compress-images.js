import imagemin from 'imagemin';
import imageminMozjpeg from 'imagemin-mozjpeg';
import imageminPngquant from 'imagemin-pngquant';
import imageminSvgo from 'imagemin-svgo';
import imageminWebp from 'imagemin-webp';
import { glob } from 'glob';
import fs from 'fs/promises';
import path from 'path';

const SRC_DIR = path.resolve('src/images');
const DEST_DIR = path.resolve('images');
const CACHE_FILE = path.resolve('node_modules/.cache/kawara-image-compress-manifest.json');

async function loadManifest() {
  try {
    const data = await fs.readFile(CACHE_FILE, 'utf8');
    return JSON.parse(data);
  } catch {
    return {};
  }
}

async function saveManifest(manifest) {
  await fs.mkdir(path.dirname(CACHE_FILE), { recursive: true });
  await fs.writeFile(CACHE_FILE, JSON.stringify(manifest, null, 2));
}

async function statIfExists(filePath) {
  try {
    return await fs.stat(filePath);
  } catch {
    return null;
  }
}

async function compressImages() {
  const sourceImageFiles = await glob('src/images/**/*.{jpg,jpeg,png,gif,svg}', {
    absolute: true,
    nodir: true
  });
  const manifest = await loadManifest();
  const nextManifest = {};
  let processedCount = 0;

  console.log(`Found ${sourceImageFiles.length} source images...`);

  for (const sourceFile of sourceImageFiles) {
    const relativePath = path.relative(SRC_DIR, sourceFile);
    const destinationFile = path.join(DEST_DIR, relativePath);
    const destinationDir = path.dirname(destinationFile);
    const ext = path.extname(destinationFile).toLowerCase();
    const stat = await fs.stat(sourceFile);
    const signature = `${stat.size}-${Math.floor(stat.mtimeMs)}`;
    const webpPath = path.join(destinationDir, `${path.basename(destinationFile, ext)}.webp`);
    const needWebp = ext === '.jpg' || ext === '.jpeg' || ext === '.png';

    nextManifest[relativePath] = signature;

    const destinationStat = await statIfExists(destinationFile);
    const destinationExists = destinationStat !== null;

    const webpStat = needWebp ? await statIfExists(webpPath) : null;
    const webpExists = !needWebp || webpStat !== null;

    const isUnchanged = manifest[relativePath] === signature;
    const outputsUpToDate = destinationExists
      && stat.mtimeMs <= destinationStat.mtimeMs
      && (!needWebp || (webpStat && stat.mtimeMs <= webpStat.mtimeMs));
    if ((isUnchanged || outputsUpToDate) && destinationExists && webpExists) {
      continue;
    }

    // 元の画像を圧縮
    await imagemin([destinationFile], {
      destination: destinationDir,
      plugins: [
        imageminMozjpeg({ quality: 80 }),
        imageminPngquant({ quality: [0.65, 0.9] }),
        imageminSvgo({
          plugins: [{ name: 'removeViewBox', active: false }]
        })
      ]
    });

    // JPGとPNGをWebPに変換
    if (needWebp) {
      await imagemin([destinationFile], {
        destination: destinationDir,
        plugins: [
          imageminWebp({ quality: 80 })
        ]
      });
      console.log(`✓ Created WebP: ${path.basename(destinationFile, ext)}.webp`);
    }

    processedCount += 1;
  }

  await saveManifest(nextManifest);
  console.log(`✓ Image compression complete! Processed ${processedCount} file(s).`);
}

compressImages().catch(error => {
  console.error('Error compressing images:', error);
  process.exit(1);
});
