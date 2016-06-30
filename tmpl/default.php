<?php
/**
 * @package        Module ETD Contact - ETD Solutions
 *
 * @version        1.0
 * @copyright      Copyright (C) 2016 ETD Solutions. Tous droits réservés.
 * @license        http://etd-solutions.com/licence
 * @author         ETD Solutions http://etd-solutions.com
 */

defined('_JEXEC') or die;

?>
<div class="mod-etdcontact text-center">
    <?php if(!empty($contact)) : ?>
        <div class="col-xs-12 col-sm-4">
            <h3>Heures d'ouverture</h3>
            <?php echo $contact->misc; ?>
        </div>
        <div class="col-xs-12 col-sm-4">
            <h3>Notre agence</h3>
            <?php if(!empty($contact->address)) : ?>
                <p><?php echo $contact->address; ?></p>
            <?php endif ; ?>
            <?php if(!empty($contact->suburb)) : ?>
                <p><?php if(!empty($contact->postcode)) : echo $contact->postcode; endif ; ?> <?php echo $contact->suburb; ?></p>
            <?php endif ; ?>
        </div>
        <div class="col-xs-12 col-sm-4">
            <h3>Vous avez une question ?</h3>
            <?php if(!empty($contact->telephone)) : ?>
                <p><?php echo $contact->telephone; ?></p>
            <?php endif ; ?>
            <?php if(!empty($contact->email_to)) : ?>
                <p><?php echo $contact->email_to; ?></p>
            <?php endif ; ?>
        </div>
    <?php endif ; ?>
</div>