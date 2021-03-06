<?php
/**
 * @package		Codingfish Discussions
 * @subpackage	com_discussions
 * @copyright	Copyright (C) 2010-2013 Codingfish (Achim Fischer). All rights reserved.
 * @license		GNU General Public License <http://www.gnu.org/copyleft/gpl.html>
 * @link		http://www.codingfish.com
 */

// no direct access
defined('_JEXEC') or die('Restricted access');


$c = $CofiUser->getCountry();


echo "<select id='country' name='country'"; if ( $c=='Australia') { echo "selected='selected'"; } echo ">";
	
	echo "<option value=''"; if ( $c=='') { echo "selected='selected'"; } echo ">Please select...</option>";
	
	echo "<option value='Germany'>Germany</option>";
	echo "<option value='Austria'>Austria</option>";
	echo "<option value='Netherlands'>Netherlands</option>";
	echo "<option value='Switzerland'>Switzerland</option>";
	echo "<option value='United Kingdom'>United Kingdom</option>";
	echo "<option value='United States'>United States</option>";
	
	echo "<option value='' disabled='disabled'>-------------</option>";
	
	
	echo "<option value='Afghanistan'"; if ( $c=='Afghanistan') { echo "selected='selected'"; } echo ">Afghanistan</option>";
	echo "<option value='Aland Islands'"; if ( $c=='Aland Islands') { echo "selected='selected'"; } echo ">Aland Islands</option>";
	echo "<option value='Albania'"; if ( $c=='Albania') { echo "selected='selected'"; } echo ">Albania</option>";
	echo "<option value='Algeria'"; if ( $c=='Algeria') { echo "selected='selected'"; } echo ">Algeria</option>";
	echo "<option value='American Samoa'"; if ( $c=='American Samoa') { echo "selected='selected'"; } echo ">American Samoa</option>";
	echo "<option value='Andorra'"; if ( $c=='Andorra') { echo "selected='selected'"; } echo ">Andorra</option>";
	echo "<option value='Angola'"; if ( $c=='Angola') { echo "selected='selected'"; } echo ">Angola</option>";
	echo "<option value='Anguilla'"; if ( $c=='Anguilla') { echo "selected='selected'"; } echo ">Anguilla</option>";
	echo "<option value='Antarctica'"; if ( $c=='Antarctica') { echo "selected='selected'"; } echo ">Antarctica</option>";
	echo "<option value='Antigua And Barbuda'"; if ( $c=='Antigua And Barbuda') { echo "selected='selected'"; } echo ">Antigua And Barbuda</option>";
	echo "<option value='Argentina"; if ( $c=='Argentina') { echo "selected='selected'"; } echo "'"; if ( $c=='Australia') { echo "selected='selected'"; } echo ">Argentina</option>";
	echo "<option value='Armenia'"; if ( $c=='Armenia') { echo "selected='selected'"; } echo ">Armenia</option>";
	echo "<option value='Aruba'"; if ( $c=='Aruba') { echo "selected='selected'"; } echo ">Aruba</option>";
	echo "<option value='Australia'"; if ( $c=='Australia') { echo "selected='selected'"; } echo ">Australia</option>";
	echo "<option value='Austria'"; if ( $c=='Austria') { echo "selected='selected'"; } echo ">Austria</option>";
	echo "<option value='Azerbaijan'"; if ( $c=='Azerbaijan') { echo "selected='selected'"; } echo ">Azerbaijan</option>";
	
	echo "<option value='Bahamas'"; if ( $c=='Bahamas') { echo "selected='selected'"; } echo ">Bahamas</option>";
	echo "<option value='Bahrain'"; if ( $c=='Bahrain') { echo "selected='selected'"; } echo ">Bahrain</option>";
	echo "<option value='Bangladesh'"; if ( $c=='Bangladesh') { echo "selected='selected'"; } echo ">Bangladesh</option>";
	echo "<option value='Barbados'"; if ( $c=='Barbados') { echo "selected='selected'"; } echo ">Barbados</option>";
	echo "<option value='Belarus'"; if ( $c=='Belarus') { echo "selected='selected'"; } echo ">Belarus</option>";
	echo "<option value='Belgium'"; if ( $c=='Belgium') { echo "selected='selected'"; } echo ">Belgium</option>";
	echo "<option value='Belize'"; if ( $c=='Belize') { echo "selected='selected'"; } echo ">Belize</option>";
	echo "<option value='Benin'"; if ( $c=='Benin') { echo "selected='selected'"; } echo ">Benin</option>";
	echo "<option value='Bermuda'"; if ( $c=='Bermuda') { echo "selected='selected'"; } echo ">Bermuda</option>";
	echo "<option value='Bhutan'"; if ( $c=='Bhutan') { echo "selected='selected'"; } echo ">Bhutan</option>";
	echo "<option value='Bolivia'"; if ( $c=='Bolivia') { echo "selected='selected'"; } echo ">Bolivia</option>";
	echo "<option value='Bosnia and Herzegowina'"; if ( $c=='Bosnia and Herzegowina') { echo "selected='selected'"; } echo ">Bosnia and Herzegowina</option>";
	echo "<option value='Botswana'"; if ( $c=='Botswana') { echo "selected='selected'"; } echo ">Botswana</option>";
	echo "<option value='Bouvet Island'"; if ( $c=='Bouvet Island') { echo "selected='selected'"; } echo ">Bouvet Island</option>";
	echo "<option value='Brazil'"; if ( $c=='Brazil') { echo "selected='selected'"; } echo ">Brazil</option>";
	echo "<option value='British Indian Ocean Territory'"; if ( $c=='British Indian Ocean Territory') { echo "selected='selected'"; } echo ">British Indian Ocean Territory</option>";
	echo "<option value='Brunei Darussalam'"; if ( $c=='Brunei Darussalam') { echo "selected='selected'"; } echo ">Brunei Darussalam</option>";
	echo "<option value='Bulgaria'"; if ( $c=='Bulgaria') { echo "selected='selected'"; } echo ">Bulgaria</option>";
	echo "<option value='Burkina Faso'"; if ( $c=='Burkina Faso') { echo "selected='selected'"; } echo ">Burkina Faso</option>";
	echo "<option value='Burundi'"; if ( $c=='Burundi') { echo "selected='selected'"; } echo ">Burundi</option>";
	
	echo "<option value='Cambodia'"; if ( $c=='Cambodia') { echo "selected='selected'"; } echo ">Cambodia</option>";
	echo "<option value='Cameroon'"; if ( $c=='Cameroon') { echo "selected='selected'"; } echo ">Cameroon</option>";
	echo "<option value='Canada'"; if ( $c=='Canada') { echo "selected='selected'"; } echo ">Canada</option>";
	echo "<option value='Cape Verde'"; if ( $c=='Cape Verde') { echo "selected='selected'"; } echo ">Cape Verde</option>";
	echo "<option value='Cayman Islands'"; if ( $c=='Cayman Islands') { echo "selected='selected'"; } echo ">Cayman Islands</option>";
	echo "<option value='Central African Republic'"; if ( $c=='Central African Republic') { echo "selected='selected'"; } echo ">Central African Republic</option>";
	echo "<option value='Chad'"; if ( $c=='Chad') { echo "selected='selected'"; } echo ">Chad</option>";
	echo "<option value='Chile'"; if ( $c=='Chile') { echo "selected='selected'"; } echo ">Chile</option>";
	echo "<option value='China'"; if ( $c=='China') { echo "selected='selected'"; } echo ">China</option>";
	echo "<option value='Christmas Island'"; if ( $c=='Christmas Island') { echo "selected='selected'"; } echo ">Christmas Island</option>";
	echo "<option value='Cocos (Keeling) Islands'"; if ( $c=='Cocos (Keeling) Islands') { echo "selected='selected'"; } echo ">Cocos (Keeling) Islands</option>";
	echo "<option value='Colombia'"; if ( $c=='Colombia') { echo "selected='selected'"; } echo ">Colombia</option>";
	echo "<option value='Comoros'"; if ( $c=='Comoros') { echo "selected='selected'"; } echo ">Comoros</option>";
	echo "<option value='Congo'"; if ( $c=='Congo') { echo "selected='selected'"; } echo ">Congo</option>";
	echo "<option value='Congo, the Democratic Republic of the'"; if ( $c=='Congo, the Democratic Republic of the') { echo "selected='selected'"; } echo ">Congo, the Democratic Republic of the</option>";
	echo "<option value='Cook Islands'"; if ( $c=='Cook Islands') { echo "selected='selected'"; } echo ">Cook Islands</option>";
	echo "<option value='Costa Rica'"; if ( $c=='Costa Rica') { echo "selected='selected'"; } echo ">Costa Rica</option>";
	echo "<option value='Cote dIvoire'"; if ( $c=='Cote dIvoire') { echo "selected='selected'"; } echo ">Cote d'Ivoire</option>";
	echo "<option value='Croatia'"; if ( $c=='Croatia') { echo "selected='selected'"; } echo ">Croatia</option>";
	echo "<option value='Cuba'"; if ( $c=='Cuba') { echo "selected='selected'"; } echo ">Cuba</option>";
	echo "<option value='Cyprus'"; if ( $c=='Cyprus') { echo "selected='selected'"; } echo ">Cyprus</option>";
	echo "<option value='Czech Republic'"; if ( $c=='Czech Republic') { echo "selected='selected'"; } echo ">Czech Republic</option>";
	
	echo "<option value='Denmark'"; if ( $c=='Denmark') { echo "selected='selected'"; } echo ">Denmark</option>";
	echo "<option value='Djibouti'"; if ( $c=='Djibouti') { echo "selected='selected'"; } echo ">Djibouti</option>";
	echo "<option value='Dominica'"; if ( $c=='Dominica') { echo "selected='selected'"; } echo ">Dominica</option>";
	echo "<option value='Dominican Republic'"; if ( $c=='Dominican Republic') { echo "selected='selected'"; } echo ">Dominican Republic</option>";
	
	echo "<option value='Ecuador'"; if ( $c=='Ecuador') { echo "selected='selected'"; } echo ">Ecuador</option>";
	echo "<option value='Egypt'"; if ( $c=='Egypt') { echo "selected='selected'"; } echo ">Egypt</option>";
	echo "<option value='El Salvador'"; if ( $c=='El Salvador') { echo "selected='selected'"; } echo ">El Salvador</option>";
	echo "<option value='Equatorial Guinea'"; if ( $c=='Equatorial Guinea') { echo "selected='selected'"; } echo ">Equatorial Guinea</option>";
	echo "<option value='Eritrea'"; if ( $c=='Eritrea') { echo "selected='selected'"; } echo ">Eritrea</option>";
	echo "<option value='Estonia'"; if ( $c=='Estonia') { echo "selected='selected'"; } echo ">Estonia</option>";
	echo "<option value='Ethiopia'"; if ( $c=='Ethiopia') { echo "selected='selected'"; } echo ">Ethiopia</option>";
	
	echo "<option value='Falkland Islands (Malvinas)'"; if ( $c=='Falkland Islands (Malvinas)') { echo "selected='selected'"; } echo ">Falkland Islands (Malvinas)</option>";
	echo "<option value='Faroe Islands'"; if ( $c=='Faroe Islands') { echo "selected='selected'"; } echo ">Faroe Islands</option>";
	echo "<option value='Fiji'"; if ( $c=='Fiji') { echo "selected='selected'"; } echo ">Fiji</option>";
	echo "<option value='Finland'"; if ( $c=='Finland') { echo "selected='selected'"; } echo ">Finland</option>";
	echo "<option value='France'"; if ( $c=='France') { echo "selected='selected'"; } echo ">France</option>";
	echo "<option value='French Guiana'"; if ( $c=='French Guiana') { echo "selected='selected'"; } echo ">French Guiana</option>";
	echo "<option value='French Polynesia'"; if ( $c=='French Polynesia') { echo "selected='selected'"; } echo ">French Polynesia</option>";
	echo "<option value='French Southern Territories'"; if ( $c=='French Southern Territories') { echo "selected='selected'"; } echo ">French Southern Territories</option>";
	
	echo "<option value='Gabon'"; if ( $c=='Gabon') { echo "selected='selected'"; } echo ">Gabon</option>";
	echo "<option value='Gambia'"; if ( $c=='Gambia') { echo "selected='selected'"; } echo ">Gambia</option>";
	echo "<option value='Georgia'"; if ( $c=='Georgia') { echo "selected='selected'"; } echo ">Georgia</option>";
	echo "<option value='Germany'"; if ( $c=='Germany') { echo "selected='selected'"; } echo ">Germany</option>";
	echo "<option value='Ghana'"; if ( $c=='Ghana') { echo "selected='selected'"; } echo ">Ghana</option>";
	echo "<option value='Gibraltar'"; if ( $c=='Gibraltar') { echo "selected='selected'"; } echo ">Gibraltar</option>";
	echo "<option value='Greece'"; if ( $c=='Greece') { echo "selected='selected'"; } echo ">Greece</option>";
	echo "<option value='Greenland'"; if ( $c=='Greenland') { echo "selected='selected'"; } echo ">Greenland</option>";
	echo "<option value='Grenada'"; if ( $c=='Grenada') { echo "selected='selected'"; } echo ">Grenada</option>";
	echo "<option value='Guadeloupe'"; if ( $c=='Guadeloupe') { echo "selected='selected'"; } echo ">Guadeloupe</option>";
	echo "<option value='Guam'"; if ( $c=='Guam') { echo "selected='selected'"; } echo ">Guam</option>";
	echo "<option value='Guatemala'"; if ( $c=='Guatemala') { echo "selected='selected'"; } echo ">Guatemala</option>";
	echo "<option value='Guernsey'"; if ( $c=='Guernsey') { echo "selected='selected'"; } echo ">Guernsey</option>";
	echo "<option value='Guinea'"; if ( $c=='Guinea') { echo "selected='selected'"; } echo ">Guinea</option>";
	echo "<option value='Guinea-Bissau'"; if ( $c=='Guinea-Bissau') { echo "selected='selected'"; } echo ">Guinea-Bissau</option>";
	echo "<option value='Guyana'"; if ( $c=='Guyana') { echo "selected='selected'"; } echo ">Guyana</option>";
	
	echo "<option value='Haiti'"; if ( $c=='Haiti') { echo "selected='selected'"; } echo ">Haiti</option>";
	echo "<option value='Heard and McDonald Islands'"; if ( $c=='Heard and McDonald Islands') { echo "selected='selected'"; } echo ">Heard and McDonald Islands</option>";
	echo "<option value='Holy See (Vatican City State)'"; if ( $c=='Holy See (Vatican City State)') { echo "selected='selected'"; } echo ">Holy See (Vatican City State)</option>";
	echo "<option value='Honduras'"; if ( $c=='Honduras') { echo "selected='selected'"; } echo ">Honduras</option>";
	echo "<option value='Hong Kong'"; if ( $c=='Hong Kong') { echo "selected='selected'"; } echo ">Hong Kong</option>";
	echo "<option value='Hungary'"; if ( $c=='Hungary') { echo "selected='selected'"; } echo ">Hungary</option>";
	
	echo "<option value='Iceland'"; if ( $c=='Iceland') { echo "selected='selected'"; } echo ">Iceland</option>";
	echo "<option value='India'"; if ( $c=='India') { echo "selected='selected'"; } echo ">India</option>";
	echo "<option value='Indonesia'"; if ( $c=='Indonesia') { echo "selected='selected'"; } echo ">Indonesia</option>";
	echo "<option value='Iran, Islamic Republic of'"; if ( $c=='Iran, Islamic Republic of') { echo "selected='selected'"; } echo ">Iran, Islamic Republic of</option>";
	echo "<option value='Iraq'"; if ( $c=='Iraq') { echo "selected='selected'"; } echo ">Iraq</option>";
	echo "<option value='Ireland'"; if ( $c=='Ireland') { echo "selected='selected'"; } echo ">Ireland</option>";
	echo "<option value='Isle of Man'"; if ( $c=='Isle of Man') { echo "selected='selected'"; } echo ">Isle of Man</option>";
	echo "<option value='Israel'"; if ( $c=='Israel') { echo "selected='selected'"; } echo ">Israel</option>";
	echo "<option value='Italy'"; if ( $c=='Italy') { echo "selected='selected'"; } echo ">Italy</option>";
	
	echo "<option value='Jamaica'"; if ( $c=='Jamaica') { echo "selected='selected'"; } echo ">Jamaica</option>";
	echo "<option value='Japan'"; if ( $c=='Japan') { echo "selected='selected'"; } echo ">Japan</option>";
	echo "<option value='Jersey'"; if ( $c=='Jersey') { echo "selected='selected'"; } echo ">Jersey</option>";
	echo "<option value='Jordan'"; if ( $c=='Jordan') { echo "selected='selected'"; } echo ">Jordan</option>";
	
	echo "<option value='Kazakhstan'"; if ( $c=='Kazakhstan') { echo "selected='selected'"; } echo ">Kazakhstan</option>";
	echo "<option value='Kenya'"; if ( $c=='Kenya') { echo "selected='selected'"; } echo ">Kenya</option>";
	echo "<option value='Kiribati'"; if ( $c=='Kiribati') { echo "selected='selected'"; } echo ">Kiribati</option>";
	echo "<option value='Korea, Democratic Peoples Republic of'"; if ( $c=='Korea, Democratic Peoples Republic of') { echo "selected='selected'"; } echo ">Korea, Democratic People's Republic of</option>";
	echo "<option value='Korea, Republic of'"; if ( $c=='Korea, Republic of') { echo "selected='selected'"; } echo ">Korea, Republic of</option>";
	echo "<option value='Kuwait'"; if ( $c=='Kuwait') { echo "selected='selected'"; } echo ">Kuwait</option>";
	echo "<option value='Kyrgyzstan'"; if ( $c=='Kyrgyzstan') { echo "selected='selected'"; } echo ">Kyrgyzstan</option>";
	
	echo "<option value='Lao Peoples Democratic Republic'"; if ( $c=='Lao Peoples Democratic Republic') { echo "selected='selected'"; } echo ">Lao People's Democratic Republic</option>";
	echo "<option value='Latvia'"; if ( $c=='Latvia') { echo "selected='selected'"; } echo ">Latvia</option>";
	echo "<option value='Lebanon'"; if ( $c=='Lebanon') { echo "selected='selected'"; } echo ">Lebanon</option>";
	echo "<option value='Lesotho'"; if ( $c=='Lesotho') { echo "selected='selected'"; } echo ">Lesotho</option>";
	echo "<option value='Liberia'"; if ( $c=='Liberia') { echo "selected='selected'"; } echo ">Liberia</option>";
	echo "<option value='Libyan Arab Jamahiriya'"; if ( $c=='Libyan Arab Jamahiriya') { echo "selected='selected'"; } echo ">Libyan Arab Jamahiriya</option>";
	echo "<option value='Liechtenstein'"; if ( $c=='Liechtenstein') { echo "selected='selected'"; } echo ">Liechtenstein</option>";
	echo "<option value='Lithuania'"; if ( $c=='Lithuania') { echo "selected='selected'"; } echo ">Lithuania</option>";
	echo "<option value='Luxembourg'"; if ( $c=='Luxembourg') { echo "selected='selected'"; } echo ">Luxembourg</option>";
	
	echo "<option value='Macao'"; if ( $c=='Macao') { echo "selected='selected'"; } echo ">Macao</option>";
	echo "<option value='Macedonia, The Former Yugoslav Republic Of'"; if ( $c=='Macedonia, The Former Yugoslav Republic Of') { echo "selected='selected'"; } echo ">Macedonia, The Former Yugoslav Republic Of</option>";
	echo "<option value='Madagascar'"; if ( $c=='Madagascar') { echo "selected='selected'"; } echo ">Madagascar</option>";
	echo "<option value='Malawi'"; if ( $c=='Malawi') { echo "selected='selected'"; } echo ">Malawi</option>";
	echo "<option value='Malaysia'"; if ( $c=='Malaysia') { echo "selected='selected'"; } echo ">Malaysia</option>";
	echo "<option value='Maldives'"; if ( $c=='Maldives') { echo "selected='selected'"; } echo ">Maldives</option>";
	echo "<option value='Mali'"; if ( $c=='Mali') { echo "selected='selected'"; } echo ">Mali</option>";
	echo "<option value='Malta'"; if ( $c=='Malta') { echo "selected='selected'"; } echo ">Malta</option>";
	echo "<option value='Marshall Islands'"; if ( $c=='Marshall Islands') { echo "selected='selected'"; } echo ">Marshall Islands</option>";
	echo "<option value='Martinique'"; if ( $c=='Martinique') { echo "selected='selected'"; } echo ">Martinique</option>";
	echo "<option value='Mauritania'"; if ( $c=='Mauritania') { echo "selected='selected'"; } echo ">Mauritania</option>";
	echo "<option value='Mauritius'"; if ( $c=='Mauritius') { echo "selected='selected'"; } echo ">Mauritius</option>";
	echo "<option value='Mayotte'"; if ( $c=='Mayotte') { echo "selected='selected'"; } echo ">Mayotte</option>";
	echo "<option value='Mexico'"; if ( $c=='Mexico') { echo "selected='selected'"; } echo ">Mexico</option>";
	echo "<option value='Micronesia, Federated States of'"; if ( $c=='Micronesia, Federated States of') { echo "selected='selected'"; } echo ">Micronesia, Federated States of</option>";
	echo "<option value='Moldova, Republic of'"; if ( $c=='Moldova, Republic of') { echo "selected='selected'"; } echo ">Moldova, Republic of</option>";
	echo "<option value='Monaco'"; if ( $c=='Monaco') { echo "selected='selected'"; } echo ">Monaco</option>";
	echo "<option value='Mongolia'"; if ( $c=='Mongolia') { echo "selected='selected'"; } echo ">Mongolia</option>";
	echo "<option value='Montenegro'"; if ( $c=='Montenegro') { echo "selected='selected'"; } echo ">Montenegro</option>";
	echo "<option value='Montserrat'"; if ( $c=='Montserrat') { echo "selected='selected'"; } echo ">Montserrat</option>";
	echo "<option value='Morocco'"; if ( $c=='Morocco') { echo "selected='selected'"; } echo ">Morocco</option>";
	echo "<option value='Mozambique'"; if ( $c=='Mozambique') { echo "selected='selected'"; } echo ">Mozambique</option>";
	echo "<option value='Myanmar'"; if ( $c=='Myanmar') { echo "selected='selected'"; } echo ">Myanmar</option>";
	
	echo "<option value='Namibia'"; if ( $c=='Namibia') { echo "selected='selected'"; } echo ">Namibia</option>";
	echo "<option value='Nauru'"; if ( $c=='Nauru') { echo "selected='selected'"; } echo ">Nauru</option>";
	echo "<option value='Nepal'"; if ( $c=='Nepal') { echo "selected='selected'"; } echo ">Nepal</option>";
	echo "<option value='Netherlands'"; if ( $c=='Netherlands') { echo "selected='selected'"; } echo ">Netherlands</option>";
	echo "<option value='Netherlands Antilles'"; if ( $c=='Netherlands Antilles') { echo "selected='selected'"; } echo ">Netherlands Antilles</option>";
	echo "<option value='New Caledonia'"; if ( $c=='New Caledonia') { echo "selected='selected'"; } echo ">New Caledonia</option>";
	echo "<option value='New Zealand'"; if ( $c=='New Zealand') { echo "selected='selected'"; } echo ">New Zealand</option>";
	echo "<option value='Nicaragua'"; if ( $c=='Nicaragua') { echo "selected='selected'"; } echo ">Nicaragua</option>";
	echo "<option value='Niger'"; if ( $c=='Niger') { echo "selected='selected'"; } echo ">Niger</option>";
	echo "<option value='Nigeria'"; if ( $c=='Nigeria') { echo "selected='selected'"; } echo ">Nigeria</option>";
	echo "<option value='Niue'"; if ( $c=='Niue') { echo "selected='selected'"; } echo ">Niue</option>";
	echo "<option value='Norfolk Island'"; if ( $c=='Norfolk Island') { echo "selected='selected'"; } echo ">Norfolk Island</option>";
	echo "<option value='Northern Mariana Islands'"; if ( $c=='Northern Mariana Islands') { echo "selected='selected'"; } echo ">Northern Mariana Islands</option>";
	echo "<option value='Norway'"; if ( $c=='Norway') { echo "selected='selected'"; } echo ">Norway</option>";
	
	echo "<option value='Oman'"; if ( $c=='Oman') { echo "selected='selected'"; } echo ">Oman</option>";
	
	echo "<option value='Pakistan'"; if ( $c=='Pakistan') { echo "selected='selected'"; } echo ">Pakistan</option>";
	echo "<option value='Palau'"; if ( $c=='Palau') { echo "selected='selected'"; } echo ">Palau</option>";
	echo "<option value='Palestinian Territory, Occupied'"; if ( $c=='Palestinian Territory, Occupied') { echo "selected='selected'"; } echo ">Palestinian Territory, Occupied</option>";
	echo "<option value='Panama'"; if ( $c=='Panama') { echo "selected='selected'"; } echo ">Panama</option>";
	echo "<option value='Papua New Guinea'"; if ( $c=='Papua New Guinea') { echo "selected='selected'"; } echo ">Papua New Guinea</option>";
	echo "<option value='Paraguay'"; if ( $c=='Paraguay') { echo "selected='selected'"; } echo ">Paraguay</option>";
	echo "<option value='Peru'"; if ( $c=='Peru') { echo "selected='selected'"; } echo ">Peru</option>";
	echo "<option value='Philippines'"; if ( $c=='Philippines') { echo "selected='selected'"; } echo ">Philippines</option>";
	echo "<option value='Pitcairn'"; if ( $c=='Pitcairn') { echo "selected='selected'"; } echo ">Pitcairn</option>";
	echo "<option value='Poland'"; if ( $c=='Poland') { echo "selected='selected'"; } echo ">Poland</option>";
	echo "<option value='Portugal'"; if ( $c=='Portugal') { echo "selected='selected'"; } echo ">Portugal</option>";
	echo "<option value='Puerto Rico'"; if ( $c=='Puerto Rico') { echo "selected='selected'"; } echo ">Puerto Rico</option>";
	
	echo "<option value='Qatar'"; if ( $c=='Qatar') { echo "selected='selected'"; } echo ">Qatar</option>";
	
	echo "<option value='Reunion'"; if ( $c=='Reunion') { echo "selected='selected'"; } echo ">Reunion</option>";
	echo "<option value='Romania'"; if ( $c=='Romania') { echo "selected='selected'"; } echo ">Romania</option>";
	echo "<option value='Russian Federation'"; if ( $c=='Russian Federation') { echo "selected='selected'"; } echo ">Russian Federation</option>";
	echo "<option value='Rwanda'"; if ( $c=='Rwanda') { echo "selected='selected'"; } echo ">Rwanda</option>";
	
	echo "<option value='Saint Barthelemy'"; if ( $c=='Saint Barthelemy') { echo "selected='selected'"; } echo ">Saint Barthelemy</option>";
	echo "<option value='Saint Helena'"; if ( $c=='Saint Helena') { echo "selected='selected'"; } echo ">Saint Helena</option>";
	echo "<option value='Saint Kitts and Nevis'"; if ( $c=='Saint Kitts and Nevis') { echo "selected='selected'"; } echo ">Saint Kitts and Nevis</option>";
	echo "<option value='Saint Lucia'"; if ( $c=='Saint Lucia') { echo "selected='selected'"; } echo ">Saint Lucia</option>";
	echo "<option value='Saint Pierre and Miquelon'"; if ( $c=='Saint Pierre and Miquelon') { echo "selected='selected'"; } echo ">Saint Pierre and Miquelon</option>";
	echo "<option value='Saint Vincent and the Grenadines'"; if ( $c=='Saint Vincent and the Grenadines') { echo "selected='selected'"; } echo ">Saint Vincent and the Grenadines</option>";
	echo "<option value='Samoa'"; if ( $c=='Samoa') { echo "selected='selected'"; } echo ">Samoa</option>";
	echo "<option value='San Marino'"; if ( $c=='San Marino') { echo "selected='selected'"; } echo ">San Marino</option>";
	echo "<option value='Sao Tome and Principe'"; if ( $c=='Sao Tome and Principe') { echo "selected='selected'"; } echo ">Sao Tome and Principe</option>";
	echo "<option value='Saudi Arabia'"; if ( $c=='Saudi Arabia') { echo "selected='selected'"; } echo ">Saudi Arabia</option>";
	echo "<option value='Senegal'"; if ( $c=='Senegal') { echo "selected='selected'"; } echo ">Senegal</option>";
	echo "<option value='Serbia'"; if ( $c=='Serbia') { echo "selected='selected'"; } echo ">Serbia</option>";
	echo "<option value='Seychelles'"; if ( $c=='Seychelles') { echo "selected='selected'"; } echo ">Seychelles</option>";
	echo "<option value='Sierra Leone'"; if ( $c=='Sierra Leone') { echo "selected='selected'"; } echo ">Sierra Leone</option>";
	echo "<option value='Singapore'"; if ( $c=='Singapore') { echo "selected='selected'"; } echo ">Singapore</option>";
	echo "<option value='Slovakia'"; if ( $c=='Slovakia') { echo "selected='selected'"; } echo ">Slovakia</option>";
	echo "<option value='Slovenia'"; if ( $c=='Slovenia') { echo "selected='selected'"; } echo ">Slovenia</option>";
	echo "<option value='Solomon Islands'"; if ( $c=='Solomon Islands') { echo "selected='selected'"; } echo ">Solomon Islands</option>";
	echo "<option value='Somalia'"; if ( $c=='Somalia') { echo "selected='selected'"; } echo ">Somalia</option>";
	echo "<option value='South Africa'"; if ( $c=='South Africa') { echo "selected='selected'"; } echo ">South Africa</option>";
	echo "<option value='South Georgia and the South Sandwich Islands'"; if ( $c=='South Georgia and the South Sandwich Islands') { echo "selected='selected'"; } echo ">South Georgia and the South Sandwich Islands</option>";
	echo "<option value='Spain'"; if ( $c=='Spain') { echo "selected='selected'"; } echo ">Spain</option>";
	echo "<option value='Sri Lanka'"; if ( $c=='Sri Lanka') { echo "selected='selected'"; } echo ">Sri Lanka</option>";
	echo "<option value='Sudan'"; if ( $c=='Sudan') { echo "selected='selected'"; } echo ">Sudan</option>";
	echo "<option value='Suriname'"; if ( $c=='Suriname') { echo "selected='selected'"; } echo ">Suriname</option>";
	echo "<option value='Svalbard and Jan Mayen'"; if ( $c=='Svalbard and Jan Mayen') { echo "selected='selected'"; } echo ">Svalbard and Jan Mayen</option>";
	echo "<option value='Swaziland'"; if ( $c=='Swaziland') { echo "selected='selected'"; } echo ">Swaziland</option>";
	echo "<option value='Sweden'"; if ( $c=='Sweden') { echo "selected='selected'"; } echo ">Sweden</option>";
	echo "<option value='Switzerland'"; if ( $c=='Switzerland') { echo "selected='selected'"; } echo ">Switzerland</option>";
	echo "<option value='Syrian Arab Republic'"; if ( $c=='Syrian Arab Republic') { echo "selected='selected'"; } echo ">Syrian Arab Republic</option>";
	
	echo "<option value='Taiwan, Province of China'"; if ( $c=='Taiwan, Province of China') { echo "selected='selected'"; } echo ">Taiwan, Province of China</option>";
	echo "<option value='Tajikistan'"; if ( $c=='Tajikistan') { echo "selected='selected'"; } echo ">Tajikistan</option>";
	echo "<option value='Tanzania, United Republic of'"; if ( $c=='Tanzania, United Republic of') { echo "selected='selected'"; } echo ">Tanzania, United Republic of</option>";
	echo "<option value='Thailand'"; if ( $c=='Thailand') { echo "selected='selected'"; } echo ">Thailand</option>";
	echo "<option value='Timor-Leste'"; if ( $c=='Timor-Leste') { echo "selected='selected'"; } echo ">Timor-Leste</option>";
	echo "<option value='Togo'"; if ( $c=='Togo') { echo "selected='selected'"; } echo ">Togo</option>";
	echo "<option value='Tokelau'"; if ( $c=='Tokelau') { echo "selected='selected'"; } echo ">Tokelau</option>";
	echo "<option value='Tonga'"; if ( $c=='Tonga') { echo "selected='selected'"; } echo ">Tonga</option>";
	echo "<option value='Trinidad and Tobago'"; if ( $c=='Trinidad and Tobago') { echo "selected='selected'"; } echo ">Trinidad and Tobago</option>";
	echo "<option value='Tunisia'"; if ( $c=='Tunisia') { echo "selected='selected'"; } echo ">Tunisia</option>";
	echo "<option value='Turkey'"; if ( $c=='Turkey') { echo "selected='selected'"; } echo ">Turkey</option>";
	echo "<option value='Turkmenistan'"; if ( $c=='Turkmenistan') { echo "selected='selected'"; } echo ">Turkmenistan</option>";
	echo "<option value='Turks and Caicos Islands'"; if ( $c=='Turks and Caicos Islands') { echo "selected='selected'"; } echo ">Turks and Caicos Islands</option>";
	echo "<option value='Tuvalu'"; if ( $c=='Tuvalu') { echo "selected='selected'"; } echo ">Tuvalu</option>";
	
	echo "<option value='Uganda'"; if ( $c=='Uganda') { echo "selected='selected'"; } echo ">Uganda</option>";
	echo "<option value='Ukraine'"; if ( $c=='Ukraine') { echo "selected='selected'"; } echo ">Ukraine</option>";
	echo "<option value='United Arab Emirates'"; if ( $c=='United Arab Emirates') { echo "selected='selected'"; } echo ">United Arab Emirates</option>";
	echo "<option value='United Kingdom'"; if ( $c=='United Kingdom') { echo "selected='selected'"; } echo ">United Kingdom</option>";
	echo "<option value='United States'"; if ( $c=='United States') { echo "selected='selected'"; } echo ">United States</option>";
	echo "<option value='United States Minor Outlying Islands'"; if ( $c=='United States Minor Outlying Islands') { echo "selected='selected'"; } echo ">United States Minor Outlying Islands</option>";
	echo "<option value='Uruguay'"; if ( $c=='Uruguay') { echo "selected='selected'"; } echo ">Uruguay</option>";
	echo "<option value='Uzbekistan'"; if ( $c=='Uzbekistan') { echo "selected='selected'"; } echo ">Uzbekistan</option>";
	
	echo "<option value='Vanuatu'"; if ( $c=='Vanuatu') { echo "selected='selected'"; } echo ">Vanuatu</option>";
	echo "<option value='Venezuela'"; if ( $c=='Venezuela') { echo "selected='selected'"; } echo ">Venezuela</option>";
	echo "<option value='Viet Nam'"; if ( $c=='Viet Nam') { echo "selected='selected'"; } echo ">Viet Nam</option>";
	echo "<option value='Virgin Islands, British'"; if ( $c=='Virgin Islands, British') { echo "selected='selected'"; } echo ">Virgin Islands, British</option>";
	echo "<option value='Virgin Islands, U.S.'"; if ( $c=='Virgin Islands, U.S.') { echo "selected='selected'"; } echo ">Virgin Islands, U.S.</option>";
	
	echo "<option value='Wallis and Futuna'"; if ( $c=='Wallis and Futuna') { echo "selected='selected'"; } echo ">Wallis and Futuna</option>";
	echo "<option value='Western Sahara'"; if ( $c=='Western Sahara') { echo "selected='selected'"; } echo ">Western Sahara</option>";
	
	echo "<option value='Yemen'"; if ( $c=='Yemen') { echo "selected='selected'"; } echo ">Yemen</option>";
	
	echo "<option value='Zambia'"; if ( $c=='Zambia') { echo "selected='selected'"; } echo ">Zambia</option>";
	echo "<option value='Zimbabwe'"; if ( $c=='Zimbabwe') { echo "selected='selected'"; } echo ">Zimbabwe</option>";

echo "</select>";


