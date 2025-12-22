import imagemin from 'imagemin';
import imageminMozjpeg from 'imagemin-mozjpeg';
import imageminPngquant from 'imagemin-pngquant';
import imageminSvgo from 'imagemin-svgo';
import imageminWebp from 'imagemin-webp';
import { glob } from 'glob';
import path from 'path';

async function compressImages() {
  const imageFiles = await glob('images/**/*.{jpg,jpeg,png,gif,svg}', {
    absolute: true,
    nodir: true
  });

  console.log(`Found ${imageFiles.length} images to compress...`);

  for (const file of imageFiles) {
    const dir = path.dirname(file);
    const ext = path.extname(file).toLowerCase();

    // 元の画像を圧縮
    await imagemin([file], {
      destination: dir,
      plugins: [
        imageminMozjpeg({ quality: 80 }),
        imageminPngquant({ quality: [0.65, 0.9] }),
        imageminSvgo({
          plugins: [{ name: 'removeViewBox', active: false }]
        })
      ]
    });

    // JPGとPNGをWebPに変換
    if (ext === '.jpg' || ext === '.jpeg' || ext === '.png') {
      await imagemin([file], {
        destination: dir,
        plugins: [
          imageminWebp({ quality: 80 })
        ]
      });
      console.log(`✓ Created WebP: ${path.basename(file, ext)}.webp`);
    }
  }

  console.log('✓ Image compression and WebP conversion complete!');
}

compressImages().catch(error => {
  console.error('Error compressing images:', error);
  process.exit(1);
});
