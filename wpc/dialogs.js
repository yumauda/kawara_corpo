/*

    Name    Dialogs
    Date    2025.09.19
    Author  Original script by Generative AI(Gemini), modified by F.I (Kawara Designs Ltd.)

*/

function cDialog(type, title, message, opt, callbackFunction) {

    const iconText = opt[0];            // アイコン指定
    let button1Text = opt[1];           // ボタン1テキスト
    let button2Text = opt[2];           // ボタン2テキスト
    const inputLength = (typeof opt[3] === "undefined") ? 30 : opt[3]; // 入力領域長さ

    // --- ダイアログの基本構造を生成 (初回のみ) ---
    if (!document.getElementById("cDialogWindow")) {
        const dialogOverlay = document.createElement('div');
        dialogOverlay.id = 'cDialogOverlay';

        const dialogWindow = document.createElement('div');
        dialogWindow.id = 'cDialogWindow';

        dialogWindow.innerHTML = `
			<div id="cDialogHeader">
				<span id="cDialogTitle"></span>
				<button id="cDialogClose">&times;</button>
			</div>
			<div id="cDialogBody">
				<span id="cDialogIcon"></span>
				&nbsp;&nbsp;&nbsp;
				<span id="cDialogMessage"></span>
				<input type="text" id="cDialogPrompt" style="display:none; width: 90%; margin-top: 10px;">
			</div>
			<div id="cDialogFooter"></div>
        `;

        document.body.appendChild(dialogOverlay);
        document.body.appendChild(dialogWindow);
    }

    // --- 要素を取得 ---
    const dialogOverlay = document.getElementById('cDialogOverlay');
    const dialogWindow = document.getElementById('cDialogWindow');
    const dialogTitle = document.getElementById('cDialogTitle');
    const dialogIcon = document.getElementById('cDialogIcon');
    const dialogMessage = document.getElementById('cDialogMessage');
    const dialogPrompt = document.getElementById('cDialogPrompt');
    const dialogFooter = document.getElementById('cDialogFooter');
    const closeButton = document.getElementById('cDialogClose');
    
    // --- 表示状態をリセット ---
    dialogFooter.innerHTML = ''; // ボタンを初期化
    dialogPrompt.style.display = 'none'; // 入力欄を非表示
    dialogPrompt.value = ''; // 入力値をクリア

    // --- ダイアログの内容を設定 ---
    dialogTitle.textContent = title;
	message = message.replaceAll("<br>", "<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");	//2行目以降の行開始位置調整のため空白追加
    dialogMessage.innerHTML = message; // HTMLタグを許容するため innerHTML を使用

    // アイコンを設定
	dialogIcon.textContent = iconText;
	dialogIcon.style.display = 'inline-block';

    // --- ボタンを生成するヘルパー関数 ---
    const createButton = (text, callbackValue) => {
        const button = document.createElement('button');
        button.textContent = text;
        button.addEventListener('click', () => {
            closeDialog();
            if (callbackFunction) {
                // promptの場合、入力値を取得
                const value = (type === 'prompt' && callbackValue !== false) 
                    ? dialogPrompt.value 
                    : callbackValue;
                callbackFunction(value);
            }
        });
        dialogFooter.appendChild(button);
    };

    // --- ダイアログ種別に応じてボタンを設定 ---
    switch (type) {
        case "alert":
            createButton(button1Text || "確認", true);
            break;

        case "confirm":
            createButton(button1Text || "はい", true);
            createButton(button2Text || "いいえ", false);
            break;

        case "prompt":
            dialogPrompt.style.display = 'block';
            dialogPrompt.size = inputLength;
            createButton(button1Text || "入力", true); // callback値は便宜上trueとし、実際の値はクリック時に取得
            createButton(button2Text || "中止", false);
            break;
    }
    
    // --- ダイアログの表示・非表示関数 ---
    const openDialog = () => {
        dialogOverlay.style.display = 'block';
        dialogWindow.style.display = 'block';
        // promptの場合、入力欄にフォーカス
        if (type === 'prompt') {
            dialogPrompt.focus();
        }
    };

    const closeDialog = () => {
        dialogOverlay.style.display = 'none';
        dialogWindow.style.display = 'none';
    };

    // ---閉じるボタンのイベント設定---
    // イベントリスナーを一度削除してから再設定し、多重登録を防ぐ
    const newCloseButton = closeButton.cloneNode(true);
    closeButton.parentNode.replaceChild(newCloseButton, closeButton);
    newCloseButton.addEventListener('click', () => {
        closeDialog();
        // 右上の×ボタンで閉じた場合は false または null を返すのが一般的
        if (callbackFunction) {
            callbackFunction(type === 'prompt' ? null : false);
        }
    });

    // --- ダイアログを表示 ---
    openDialog();
}