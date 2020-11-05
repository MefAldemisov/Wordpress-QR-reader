<?php
if ($_POST['qr_reader_hidden'] == 'Y') {
    //Form data sent
    $db_btn_text = $_POST['qr_reader_btn_text'];
    $db_error_text =  $_POST['qr_reader_error_text'];
    $db_redirect_text = $_POST['qr_reader_redirect_text'];

    update_option('qr_reader_btn_text', $db_btn_text);
    update_option('qr_reader_error_text', $error_text);
    update_option('qr_reader_redirect_text', $redirect_text);

?>
    <div class="updated">
        <p><strong><?php _e('Options saved.'); ?></strong></p>
    </div>
<?php
} else {
    //Normal page display
    $db_btn_text = get_option('qr_reader_btn_text', 'Отсканировать QR-код');
    $db_error_text = get_option('qr_reader_error_text', 'Ошибка: Данный QR код не содержит URL');
    $db_redirect_text = get_option('qr_reader_redirect_text', 'Перейти');
}
?>


<div class="wrap">
    <?php echo "<h2>" . __('Qr reader', 'qr_reader_trdom') . "</h2>"; ?>

    <form name="qr_reader_form" method="post" action="<?php echo str_replace('%7E', '~', $_SERVER['REQUEST_URI']); ?>">
        <input type="hidden" name="qr_reader_hidden" value="Y">
        <div>
            <p><?php _e("Text within a button: "); ?>
                <input type="text" name="qr_reader_btn_text" value="<?php echo $db_btn_text; ?>">
            </p>
        </div>
        <div>
            <p><?php _e("Text in case, when text, readed from QR is not a URL: "); ?>
                <input type="text" name="qr_reader_error_text" value="<?php echo $db_error_text; ?>">
            </p>
        </div>
        <div>
            <p><?php _e("Text within a button to redirect user: "); ?>
                <input type="text" name="qr_reader_redirect_text" value="<?php echo $db_redirect_text; ?>">
            </p>
        </div>
        <div>
            <p class="submit">
                <input type="submit" name="Submit" value="<?php _e('Update', 'qr_reader_trdom') ?>" />
            </p>
        </div>
    </form>
</div>