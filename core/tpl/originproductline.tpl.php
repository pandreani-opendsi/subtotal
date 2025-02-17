<?php
/* Copyright (C) 2010-2012	Regis Houssin	<regis.houssin@inodbox.com>
/* Copyright (C) 2017		Charlie Benke	<charlie@patas-monkey.com>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <https://www.gnu.org/licenses/>.
 */

// Protection to avoid direct call of template
if (empty($conf) || ! is_object($conf))
{
	print "Error, template page can't be called as URL";
	exit;
}

?>

<!-- BEGIN PHP TEMPLATE originproductline.tpl.php -->
<?php

$selected=1;

if ($this->tpl['subtotal'] != $this->tpl['id'] || !in_array($this->tpl['sub-type'], array('title', 'total')))
{
	print '<tr data-id="'.$this->tpl['id'].'" class="oddeven'.(empty($this->tpl['strike'])?'':' strikefordisabled').'">';
	print '<td class="linecolref">'.$this->tpl['label'].'</td>';
	print '<td class="linecoldescription">'.$this->tpl['description'].'</td>';
	print '<td class="linecolvat right">'.$this->tpl['vat_rate'].'</td>';
	print '<td class="linecoluht right">'.$this->tpl['price'].'</td>';
	if (!empty($conf->multicurrency->enabled))
		print '<td class="linecoluht_currency right">'.$this->tpl['multicurrency_price'].'</td>';

	print '<td class="linecolqty right">'.$this->tpl['qty'].'</td>';
	if($conf->global->PRODUCT_USE_UNITS)
		print '<td class="linecoluseunit left">'.$langs->trans($this->tpl['unit']).'</td>';

	print '<td class="linecoldiscount right">'.$this->tpl['remise_percent'].'</td>';
	// La colonne Total HT ne sera disponible qu'en 16.0, du coup tant qu'il n'y a pas de donn�es, inutile d'afficher la td car elle n'aura pas de titre de colonne ni de valeur
	if(!empty($this->tpl['total_ht'])) print '<td class="right">'.$this->tpl['total_ht'].'</td>';


	if (!empty($selectedLines) && !in_array($this->tpl['id'], $selectedLines)) $selected=0;
	print '<td class="center">';
	print '<input id="cb'.$this->tpl['id'].'" class="flat checkforselect" type="checkbox" name="toselect[]" value="'.$this->tpl['id'].'"'.($selected?' checked="checked"':'').'>';
	print '</td>';
	print '</tr>'."\n";
}
else
{

    $colspan = 6;
    if($conf->multicurrency->enabled) $colspan++;
    if($conf->global->PRODUCT_USE_UNITS) $colspan++;
	print '<tr class="oddeven'.(empty($this->tpl['strike'])?'':' strikefordisabled').'" '.(!empty($this->tpl['sub-tr-style']) ? 'style="'.$this->tpl['sub-tr-style'].'"' : '').'>';
	print '<td colspan="'.$colspan.'" '.$this->tpl['sub-td-style'].'>'.$this->tpl["sublabel"].'</td>';

	if (!empty($selectedLines) && !in_array($this->tpl['id'], $selectedLines)) $selected=0;
	print '<td class="center">';
	print '<input id="cb'.$this->tpl['id'].'" class="flat checkforselect" type="checkbox" name="toselect[]" value="'.$this->tpl['id'].'"'.($selected?' checked="checked"':'').'>';
	print '</td>';
	print '</tr>'."\n";
}
?>
<!-- END PHP TEMPLATE originproductline.tpl.php -->