<?php
include_once 'database.php';
include_once 'xmlconverter.php';

$xmlFilePath = 'Kristall-voda.xml';

$query = "SELECT * 
        FROM oc_product AS pr
        LEFT JOIN oc_product_option_value AS val 
                ON pr.product_id = val.product_id
                
        LEFT JOIN oc_product_option AS opt
                ON pr.product_id = opt.product_id 
                AND val.product_option_id = opt.product_option_id

        LEFT JOIN oc_product_description AS descr
                ON pr.product_id = descr.product_id

        LEFT JOIN oc_product_attribute AS att
                ON pr.product_id = att.product_id
                AND descr.language_id = att.language_id

        LEFT JOIN oc_product_theirsystem_properties AS prop
                ON pr.product_id = prop.product_id
                AND descr.language_id = prop.language_id

        LEFT JOIN oc_product_recurring AS rec
                ON pr.product_id = rec.product_id

        LEFT JOIN oc_product_discount AS dis
                ON pr.product_id = dis.product_id
                AND dis.customer_group_id = rec.customer_group_id

        LEFT JOIN oc_product_special AS spe
                ON pr.product_id = spe.product_id
                AND spe.customer_group_id = rec.customer_group_id

        LEFT JOIN oc_product_reward AS rew
                ON pr.product_id = rew.product_id
                AND rew.customer_group_id = rec.customer_group_id

        LEFT JOIN oc_product_image AS im
                ON pr.product_id = im.product_id

        LEFT JOIN oc_product_filter AS fil
                ON pr.product_id = fil.product_id

        LEFT JOIN oc_product_related AS rel
                ON pr.product_id = rel.product_id

        LEFT JOIN oc_product_to_store AS sto
                ON pr.product_id = sto.product_id

        LEFT JOIN oc_product_to_layout AS lay
                ON pr.product_id = lay.product_id
                AND lay.store_id = sto.store_id

        LEFT JOIN oc_product_to_category AS cat
                ON pr.product_id = cat.product_id

        LEFT JOIN oc_product_to_download AS dow
                ON pr.product_id = dow.product_id
        ORDER BY pr.product_id";

$db = new Database();
$db->getConnection();
$result = $db->query($query);

$xml = new xmlconverter($xmlFilePath);
$xml->createXMLfile($result);
