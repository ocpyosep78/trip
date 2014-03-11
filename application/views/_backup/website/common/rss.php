<?php
    $rss_content = '';
    foreach ($array_item as $key => $item) {
        $rss_content .= '
            <item>
                <title>'.htmlentities($item['name']).'</title>
                <description><![CDATA[ '.$item['content_limit'].' ]]></description>
                <link>'.$item['advert_link'].'</link>
            </item>';
    }
    
	header('content-type: application/xhtml+xml; charset=utf-8');
    echo "<?xml version='1.0' encoding='UTF-8'?>\n";
?>
<rss version="2.0">
<channel>
    <title><?php echo $title; ?></title>
    <link><?php echo $link; ?></link>
    <description><?php echo $description; ?></description>
    <?php echo $rss_content; ?>
</channel>
</rss>