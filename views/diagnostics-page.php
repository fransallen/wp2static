<br>

<table class="widefat striped">
    <thead>
        <tr>
            <th>Health check</th>
            <th>Status</th>
            <th>Advice</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Non-public dev server</td>
            <td>
                <p>Use our non-tracking service to check if your site is protected from public access.</p>

                <button class="button btn-primary">Check</button>
            </td>
            <td>WP2Static should be running on a non-production development server, protected from public access.</td>
        </tr>
        <tr>
            <td>Local DNS resolution</td>
            <td>
<?php

$dash_icon = 'dashicons-editor-help';
$color = 'gray';

switch($view['localDNSResolution']) {
    case '':
        $dash_icon = 'dashicons-editor-help';
        $color = '#FE8F25';

        break;
    case 'Private':
        $dash_icon = 'dashicons-yes';
        $color = '#3ad23a';

        break;
    case 'Public':
        $dash_icon = 'dashicons-no';
        $color = 'red';

        break;
}

?>
                <?php echo $view['localDNSResolution'] ? $view['localDNSResolution'] : 'Unknown'; ?>

                <span
                    class="dashicons <?php echo $dash_icon; ?>"
                    style="color: <?php echo $color; ?>;"
                ></span>
            </td>
            <td>Crawling your site will be faster if WP2Static doesn't have to go the long route when fetching URLs. Ensure your WordPress site's URL resolves locally.</td>
        </tr>
        <tr>
            <td>PHP max_execution_time</td>
            <td>
                <?php echo $view['maxExecutionTime'] == 0 ? 'Unlimited' : $view['maxExecutionTime'] . ' secs'; ?>

                <span
                    class="dashicons <?php echo $view['maxExecutionTime'] == 0 ? 'dashicons-yes' : 'dashicons-no'; ?>"
                    style="color: <?php echo $view['maxExecutionTime'] == 0 ? 'green' : 'red'; ?>;"
                ></span>
            </td>
            <td>Generating a static site can involve long-running processes. Set your PHP max_execution_time setting to unlimited or find a better webhost if you're prevented from doing so.</td>
        </tr>
        <tr>
            <td>PHP memory_limit</td>
            <td>
                <?php echo $view['memoryLimit']; ?>

            </td>
            <td>WP2Static will use as much memory as is available to it during processing. Allocating more of your system RAM to PHP should improve performance.</td>
        </tr>
        <tr>
            <td>Uploads directory writable</td>
            <td>
                <?php echo $view['uploadsWritable']  ? 'Writable' : 'Non-writable'; ?>

                <span
                    class="dashicons <?php echo $view['uploadsWritable'] ? 'dashicons-yes' : 'dashicons-no'; ?>"
                    style="color: <?php echo $view['uploadsWritable'] ? 'green' : 'red'; ?>;"
                ></span>
            </td>
            <td>Generating a static site can involve long-running processes. Set your PHP max_execution_time setting to unlimited or find a better webhost if you're prevented from doing so.</td>
        </tr>
        <tr>
            <td>PHP version</td>
            <td>
                <?php echo PHP_VERSION; ?>

                <span
                    class="dashicons <?php echo ! $view['phpOutOfDate'] ? 'dashicons-yes' : 'dashicons-no'; ?>"
                    style="color: <?php echo ! $view['phpOutOfDate'] ? 'green' : 'red'; ?>;"
                ></span>
            </td>
            <td>
              <p>The current officially supported PHP versions can be found on <a href="http://php.net/supported-versions.php" target="_blank">PHP.net</a></p>

              <p>As official security support drops for PHP 7.2 at the end of 2020, it is strongly recommended to upgraded your WordPress hosting environment to PHP 7.3 or above.<br><br>For help on upgrading your environment, please join our support community at <a href="https://wp2static.com/community/" target="_blank">https://wp2static.com/community/</a></p>
            </td>
        </tr>
        <tr>
            <td>cURL extension loaded</td>
            <td>
                <?php echo $view['curlSupported'] ? 'Yes' : 'No'; ?>

                <span
                    class="dashicons <?php echo $view['curlSupported'] ? 'dashicons-yes' : 'dashicons-no'; ?>"
                    style="color: <?php echo $view['curlSupported'] ? 'green' : 'red'; ?>;"
                ></span>
            </td>
            <td>
                <p>You need the cURL extension enabled on your web server</p>

                <p> This is a library that allows the plugin to better export your static site out to services like GitHub, S3, Dropbox, BunnyCDN, etc. It's usually an easy fix to get this working. You can try Googling "How to enable cURL extension for PHP", along with the name of the environment you are using to run your WordPress site. This may be something like DigitalOcean, GoDaddy or LAMP, MAMP, WAMP for your webserver on your local computer. If you're still having trouble, the developer of this plugin is easger to help you get up and running. Please ask for help on our <a href="https://forum.wp2static.com">forum</a>.</p>
            </td>
        </tr>
        <tr>
            <td>WordPress Permalinks Defined</td>
            <td>
                <?php echo $view['permalinksDefined'] ? 'Yes' : 'No'; ?>

                <span
                    class="dashicons <?php echo $view['permalinksDefined'] ? 'dashicons-yes' : 'dashicons-no'; ?>"
                    style="color: <?php echo $view['permalinksDefined'] ? 'green' : 'red'; ?>;"
                ></span>
            </td>
            <td>
                <p>Due to the nature of how static sites work, you'll need to have some kind of permalinks structure defined in your <a href="<?php echo admin_url( 'options-permalink.php' ); ?>">Permalink Settings</a> within WordPress. To learn more on how to do this, please see WordPress's official guide to the <a href="https://codex.wordpress.org/Settings_Permalinks_Screen">Settings Permalinks Screen</a>.</p>
            </td>
        </tr>
    </tbody>
</table>


<h4>Loaded PHP extensions</h4>

<table class="widefat striped">
    <tbody>

<?php
natcasesort($view['extensions']);
$ar_list = $view['extensions'];
$rows = ceil(count($ar_list) / 5);
$lists  = array_chunk($ar_list, $rows);

foreach ( $lists as $column) {
    echo '<tr>';
    foreach ($column as $item) {
        echo '<td>' . $item . '</td>';
    }
    echo '</tr>';
}

?>
    </tbody>
</table>

<h4>WP2Static Core Options</h4>

<table class="widefat striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Value</th>
        </tr>
    </thead>
    <tbody>

        <?php foreach ( $view['coreOptions'] as $option) : ?>

           <tr>
           <td><?php echo $option['label'];?></td>
           <td><?php echo $option['value'];?></td>
           </tr>

        <?php endforeach; ?>

    </tbody>
</table>

<h4>WordPress Site Info</h4>

<table class="widefat striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Value</th>
        </tr>
    </thead>
    <tbody>

        <?php
        // TODO: sort site infos alpha
        foreach ( $view['site_info'] as $name => $value) : ?>
           <tr>
           <td><?php echo $name;?></td>
           <td><?php echo $value;?></td>
           </tr>

        <?php endforeach; ?>

    </tbody>
</table>

<div style="display:none;">
    <b>TODO: load add-on diagnostics here, via filter</b>

    ie

    <p>PHP DOMDocument library available</p>
    <code>        $view['domDocumentAvailable'] = class_exists( 'DOMDocument' );</code>
    <h2 class="title">You're missing a required PHP library (DOMDocument)</h2>
    <p> This is a library that is used to parse the HTML documents when WP2Static crawls your site. It's usually an easy fix to get this working. You can try Googling "DOMDocument missing", along with the name of the environment you are using to run your WordPress site. This may be something like DigitalOcean, GoDaddy or LAMP, MAMP, WAMP for your webserver on your local computer. If you're still having trouble, the developer of this plugin is easger to help you get up and running. Please ask for help on our <a href="https://forum.wp2static.com">forum</a>.</p>
</div>
