<?php
/**
 * 投稿マニュアル管理（一覧案内共通 ＋ ピックアップ詳細 ＋ お知らせ詳細 ＋ 固定ページ用案内）
 */

// ==========================================
// 1. 各編集画面のメタボックス（画面下）の登録
// ==========================================
function add_custom_instruction_meta_boxes($post_type, $post)
{
    // 【ピックアップ専用】の詳細手順
    add_meta_box(
        'pickup_instruction_box',
        '投稿の手順（詳細ルール）',
        'render_pickup_instruction_box',
        'pickup',
        'normal',
        'high'
    );

    // 【お知らせ用】の詳細手順
    add_meta_box(
        'news_instruction_box',
        '投稿の手順（詳細ルール）',
        'render_news_instruction_box',
        'news', 
        'normal',
        'high'
    );

    // 【新着入荷商品用】の詳細手順
    add_meta_box(
        'new_arrival_instruction_box',
        '投稿の手順（詳細ルール）',
        'render_new_arrival_instruction_box',
        'new_arrival',
        'normal',
        'high'
    );

    // 【固定ページ用】案内メタボックス
    if ($post_type === 'page') {
        $box_title = ($post && $post->post_name === 'recruit') ? '募集要項の編集手順' : 'ページの編集に関するご注意';

        add_meta_box(
            'page_instruction_box',
            $box_title,
            'render_page_instruction_box',
            'page',
            'normal',
            'high'
        );
    }
}
add_action('add_meta_boxes', 'add_custom_instruction_meta_boxes', 10, 2);


// ==========================================
// メタボックスの中身（ピックアップ用）
// ==========================================
function render_pickup_instruction_box()
{
    ?>
    <div style="font-size: 13px; line-height: 1.6; color: #333;">
        <p style="margin: 0 0 8px 0;"><strong>1. タイトル入力</strong><br>- 記事のタイトルを入力します。</p>
        <p style="margin: 0 0 8px 0;"><strong>2. アイキャッチ画像（左側バナー）の設定</strong><br>- 右上の「保存」ボタンの左隣にある「設定」アイコンを開き、その中の「アイキャッチ画像を設定」を選択し、該当のバナー画像を設定します。（推奨サイズ：280×210px）</p>
        <p style="margin: 0 0 8px 0;"><strong>3. 抜粋（一覧用コメント）の設定</strong><br>- 2.と同じく右上の「保存」ボタンの左隣にある「設定」アイコンを開き、「抜粋」項目にピックアップ一覧ページへ掲載したいコメントを入力します。</p>
        <p style="margin: 0 0 0 0;"><strong>4. 本文の構成・入力ルール</strong><br>
            - サブタイトルは「H3（見出し3）」を選択し、先頭に「■」を付けて入力します。<br>
            - 本文はそのまま通常テキストとして入力します。<br>
            - 箇条書きを使う場合は、ブロックから「リスト」を選択して入力します。<br>
            - <strong>改行を細かく調整したい場合：</strong><br>
            改行したい文章のブロックを選択し、上のメニュー（三点リーダー）から「HTMLとして編集」を選んで、必要な場所に以下のタグを挿入します。<br>
            ・PC・スマホ共通：<code>&lt;br&gt;</code><br>
            ・PCのみ：<code>&lt;br class="pc-br"&gt;</code><br>
            ・スマホのみ：<code>&lt;br class="sp-br"&gt;</code></p>
        ※タイトルには適用不可<br>※抜粋（一覧用コメント）には、直接<code>&lt;br&gt;</code>などのタグを挿入すれば適用可能
        <p style="margin: 10px 0 0 0;">2026/10/26時点のWordPress画面での手順となります。</p>
    </div>
    <?php
}


// ==========================================
// メタボックスの中身（お知らせ用）
// ==========================================
function render_news_instruction_box()
{
    ?>
    <div style="font-size: 13px; line-height: 1.6; color: #333;">
        <p style="margin: 0 0 8px 0;"><strong>1. タイトル入力</strong><br>- 記事のタイトルを入力します。</p>
        <p style="margin: 0 0 0 0;"><strong>2. 本文の構成・入力ルール</strong><br>
            - サブタイトルは「H3（見出し3）」を選択し、先頭に「■」を付けて入力します。<br>
            - 本文はそのまま通常テキストとして入力します。<br>
            - 箇条書きを使う場合は、ブロックから「リスト」を選択して入力します。<br>
            - <strong>改行を細かく調整したい場合：</strong><br>
            改行したい文章のブロックを選択し、上のメニュー（三点リーダー）から「HTMLとして編集」を選んで、必要な場所に以下のタグを挿入します。<br>
            ・PC・スマホ共通：<code>&lt;br&gt;</code><br>
            ・PCのみで改行：<code>&lt;br class="pc-br"&gt;</code><br>
            ・スマホのみで改行：<code>&lt;br class="sp-br"&gt;</code></p>
            ※タイトルには適用不可
        <p style="margin: 10px 0 0 0;">2026/10/26時点のWordPress画面での手順となります。</p>
    </div>
    <?php
}


// ==========================================
// メタボックスの中身（新着入荷商品用）
// ==========================================
function render_new_arrival_instruction_box()
{
    ?>
    <div style="font-size: 13px; line-height: 1.6; color: #333;">
        <p style="margin: 0 0 8px 0;"><strong>1. 商品管理番号の入力</strong><br>- 一番上の欄に商品管理番号を入力します。</p>
        <p style="margin: 0 0 8px 0;"><strong>2. 価格（税抜）の入力</strong><br>- 価格の数字を入力します（カンマや税込価格は自動で計算・表示されます）。</p>
        <p style="margin: 0 0 8px 0;"><strong>3. ブランド名の入力</strong><br>- ブランド名を入力します。</p>
        <p style="margin: 0 0 8px 0;"><strong>4. サイズの入力</strong><br>- サイズを入力します。</p>
        <p style="margin: 0 0 8px 0;"><strong>5. 入荷日の入力</strong><br>- 例（<code>2026.11.08</code>）に習ってドット（.）で区切って日付を入力します。</p>
        <p style="margin: 0 0 0 0;"><strong>6. アイキャッチ画像の設定</strong><br>- 画面右下の「アイキャッチ画像」より画像を設定します（推奨：200×200px）。</p>
    </div>
    <?php
}


// ==========================================
// メタボックスの中身（固定ページ用／分岐）
// ==========================================
function render_page_instruction_box($post)
{
    if ($post && $post->post_name === 'recruit') {
        ?>
        <div style="font-size: 13px; line-height: 1.6; color: #333;">
            <p style="margin: 0 0 12px 0; font-weight: 600; color: #333; font-size: 14px;">
                以下項目のみ変更可能です。以下のテキストボックスより直接編集してください。
            </p>
            <p style="margin: 0 0 8px 0;"><strong>1. 勤務時間の変更</strong><br>- 「勤務時間」のテキストボックスから、時間やシフトの条件を直接書き換えてください。</p>
            <p style="margin: 0 0 8px 0;"><strong>2. 勤務日数の変更</strong><br>- 「勤務日数」のテキストボックスから、日数の条件を直接書き換えてください。</p>
            <p style="margin: 0 0 0 0;"><strong>3. 給与の変更</strong><br>- 「給与」のテキストボックスから、時給などの金額を直接書き換えてください。</p><br>
            <p style="margin: 0 0 12px 0; font-weight: 600; color: #d63638; font-size: 14px;">
                その他の内容は管理画面より変更できません。<br>
                変更をご希望の際は、担当エンジニアまでご連絡ください。
            </p>

            <div style="background-color: #f6f7f7; border-left: 4px solid #72a24d; padding: 10px 12px; margin-top: 12px;">
                <p style="margin: 0 0 4px 0; font-weight: 600; color: #1d2327;">
                    ※ 担当エンジニアの方へ
                </p>
                <p style="margin: 0; color: #50575e; font-size: 12px; line-height: 1.5;">
                    コードファイルを編集後、該当ページの本文化された内容をこちらの管理画面の本文エリアにもコピー＆ペーストしてください。<br>
                    こちらの管理画面に記載された内容をAIに読み込ませ、チャットボットの情報源として利用しています。
                </p>
        </div>

        <?php
    } else {
        ?>
        <div style="font-size: 13px; line-height: 1.6; color: #333;">
            <p style="margin: 0 0 12px 0; font-weight: 600; color: #d63638; font-size: 14px;">
                本ページの内容は管理画面より変更できません。<br>
                変更をご希望の際は、担当エンジニアまでご連絡ください。
            </p>
            <div style="background-color: #f6f7f7; border-left: 4px solid #72a24d; padding: 10px 12px; margin-top: 8px;">
                <p style="margin: 0 0 4px 0; font-weight: 600; color: #1d2327;">※ 担当エンジニアの方へ</p>
                <p style="margin: 0; color: #50575e; font-size: 12px;">
                    コードファイルを編集後、該当ページの本文化された内容をこちらの管理画面の本文エリアにもコピー＆ペーストしてください。<br>
                    こちらの管理画面に記載された内容をAIに読み込ませ、チャットボットの情報源として利用しています。
                </p>
            </div>
        </div>
        <?php
    }
}


// ==========================================
// 一覧画面の共通案内表示
// ==========================================
function display_common_list_notice()
{
    global $pagenow;

    if ('edit.php' === $pagenow) {
        if (isset($_GET['post_type']) && 'new_arrival' === $_GET['post_type']) {
            return;
        }
        ?>
        <div class="notice notice-info" style="border-left-color: #443b57; padding: 12px 15px; margin: 20px 0 15px 0; background: #fff;">
            <p style="margin: 0; font-size: 13px; color: #1d2327; font-weight: 600;">
                ★ 内容変更や投稿・更新の手順は各編集画面のメタボックス（画面下）を確認してください。
            </p>
        </div>
        <?php
    }
}
add_action('admin_notices', 'display_common_list_notice');