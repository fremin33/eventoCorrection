<?php

add_action("admin_menu", "theme_config");

function theme_config()
{
    add_menu_page("Réseaux sociaux", "Réseaux sociaux", "administrator", "theme-config", "display_config", "dashicons-email-alt", 107);
}

function display_config()
{
    if (isset($_POST["theme_update"])) {
        foreach ($_POST["options"] as $name => $value) {
            if (empty($value)) {
                delete_option($name);
            } else {
                update_option($name, $value);
            }
        }
        ?>
        <div id="message" class="updated fade">
            <p>Options sauvegardées</p>
        </div>
        <?php
    }
    ?>

    <div class="wrap">
        <h2>Configuration des coordonnées</h2>
        <hr>
        <form action="" method="post">
            <table class="form-table">
                <tr>
                    <th colspan="2"><h3>Réseaux sociaux</h3>
                        <hr>
                    </th>
                </tr>
                <tr>
                    <th><label for="facebook">Facebook</label></th>
                    <td><input type="text" name="options[facebook]" id="facebook"
                               value="<?php echo esc_attr(get_option("facebook")); ?>" size="50"/></td>
                </tr>
                <tr>
                    <th><label for="twitter">Twitter</label></th>
                    <td><input type="text" name="options[twitter]" id="twitter"
                               value="<?php echo esc_attr(get_option("twitter")); ?>" size="50"/></td>
                </tr>
                <tr>
                    <th><label for="gplus">Google plus</label></th>
                    <td><input type="text" name="options[gplus]" id="gplus"
                               value="<?php echo esc_attr(get_option("gplus")); ?>" size="50"/></td>
                </tr>
                <tr>
                    <th><label for="yt">YouTube</label></th>
                    <td><input type="text" name="options[yt]" id="yt" value="<?php echo esc_attr(get_option("yt")); ?>"
                               size="50"/></td>
                </tr>
            </table>
            <input type="hidden" name="theme_noncename" value="<?php wp_create_nonce("theme_config"); ?>"/>
            <hr>
            <p class="submit"><input type="submit" class="button-primary" name="theme_update" value="Enregistrer"/></p>
        </form>
    </div>

    <?php
}

?>
