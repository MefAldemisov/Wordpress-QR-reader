<?php
if ($_POST['qr_reader_hidden'] == 'Y') {
    //Form data sent
    $db_btn_text = $_POST['qr_reader_btn_text'];
    update_option('qr_reader_btn_text', $db_btn_text);
?>
    <div class="updated">
        <p><strong><?php _e('Options saved.'); ?></strong></p>
    </div>
<?php
    } else {
        //Normal page display
        $db_btn_text = get_option('qr_reader_btn_text');
    }
?>


<div class="wrap">
    <?php echo "<h2>" . __('Qr reader', 'qr_reader_trdom') . "</h2>"; ?>

    <form name="qr_reader_form" method="post" action="<?php echo str_replace('%7E', '~', $_SERVER['REQUEST_URI']); ?>">
        <input type="hidden" name="qr_reader_hidden" value="Y">

        <p><?php _e("Text within a button: "); ?>
            <input type="text" name="qr_reader_btn_text" value="<?php echo $db_btn_text; ?>">
        </p>
        <p class="submit">
            <input type="submit" name="Submit" value="<?php _e('Update', 'qr_reader_trdom') ?>" />
        </p>
    </form>
</div>