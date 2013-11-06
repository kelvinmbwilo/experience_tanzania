<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of form
 *
 * @author kelvin
 */
class form {
   
    static function addUser($sArray,$tableName)
        {
            $arrLength = count($sArray);
            $counter = 0;
            
            $inQuery = "INSERT INTO {$tableName}(";
            foreach ($sArray as $key => $value) 
                {
                $counter++;
                $inQuery .= ($counter == $arrLength)?$key:$key . ",";
            }
            
            $inQuery .= ") VALUES(" ;
            $valCnter = 0;
            foreach ($sArray as $key => $value) 
                {
                $valCnter++;
                $value = mysql_real_escape_string($value);
                $inQuery .= ($valCnter == $arrLength)?"'" .$value."'":"'".$value. "',";
            }
            
            $inQuery .= ")";
            
            //echo $inQuery;
            
            $squery = mysql_query($inQuery) or die(mysql_error());
        }
        
         static function editUser($sArray,$tableName,$id,$idvalue)
        {
            $arrLength = count($sArray);
            $counter = 0;
            
            $inQuery = "UPDATE {$tableName} SET ";
            foreach ($sArray as $key => $value) 
                {
                $counter++;
                $inQuery .= ($counter == $arrLength)?" {$key}='{$value}' ":" {$key}='{$value}' " . ",";
            }
            $inQuery .=" WHERE {$id}='{$idvalue}'";
            //echo $inQuery;
            
            $squery = mysql_query($inQuery) or die(mysql_error());
        }
    
   
    static function secretQuestions($name){
        $str = "<select name='$name'>";
        $str .= "<option disabled='disabled' selected='selected'>Secret Question</option>";
        $str .= "<option>What is yor best friends name</option>";
        $str .= "<option>What is your favorite teachers name</option>";
        $str .= "<option>What place do you like most</option>";
        $str .= " <option>What is the name of your close relative</option>";
        $str .= "</select>";
        return $str;
    }
    
    static function MaritalStatus($name,$selected){
        
        $arr = array("Married","Single","Devorced");
        $str = "<select name='{$name}' id='{$name}' class='validate[required]'>";
        foreach ($arr as $value) {
            if($value == $selected){
                $str .="<option selected='selected'>$value</option>";
            }else{
                $str .="<option>$value</option>";
            }
        }
        $str .= "</select>";
        return $str;
    }
    
      
     static function EducationDropdown($name,$selected){
       
        $arr = array("Education Level","Certificate","Diploma","Degree","Master","PhD");
        $str = "<select name='{$name}' id='{$name}' class='validate[required]'>";
        foreach ($arr as $value) {
            if($value == $selected){
                $str .="<option selected='selected'>$value</option>";
            }else{
                $str .="<option>$value</option>";
            }
        }
        $str .= "</select>";
        return $str;
        
    }
    
    static function categoryDropdown($name,$selected){
        echo "<select  name='{$name}' id='{$name}' class='form-control validate[required]'>";
       $arr = array("Accountong and Book Keeping","Administration and Office Management"
                    ,"Construction","Consultant","Banking and Finance","Advertising, Sales and Marketing"
                    ,"Customer Services and Relation","Communication","Drivers","Data Entry","Education and Teaching","Engineering"
                    ,"Food Services and Hospitality","Fitness and Sport Instructor","Government","Graphics Art and Video"
                    ,"Human Resources","Insurance","IT Systems and Network Administration","Legal Logistics and Transportation"
                    ,"Management","Manufacturing","Mechanical","Medical and Dental","Mining","NGO","Operations","Procurement and Supply"
                    ,"Project and Program Management","Public Health","Research Monitoring and Evaluation","Security","Travel and Tourism","Web Design and Administration"
                    ,"Journalism","House Hold Cooks","House Keeper","Gardeners","Other");
                    foreach ($arr as $value) {
                      if(in_array($value, $selected)){
                            echo "<option selected='selected'>{$value}</option>";
                        }else{
                        echo "<option>{$value}</option>";
                        }
                    }
                    echo "</select>";
    }
    
        
    //a static function to display number of rooms dropdown
    static function number($name,$selected){
        $arr = array("0","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20");
        $str = "<select name='$name' id='$name'>";
        foreach ($arr as $value) {
            if($value == $selected){
                $str .="<option selected='selected'>$value</option>";
            }else{
                $str .="<option>$value</option>";
            }
        }
        $str .= "</select>";
        return $str;
    }
    
        
   static function genderDropdown($selected){
        $str = "<select name='gender' id='gender' class='validate[required]'>";
        $str .= "<option value=''><i class='fa fa-female'></i>Sex</option>";
        if($selected == "Female"){
            $str .= "<option value='Female' selected='selected'><i class='fa fa-female'></i>Female</option>";
        }else{
            $str .= "<option value='Female'><i class='fa fa-female'></i>Female</option>";
        }
        if($selected == "Male"){
            $str .= "<option value='Male' selected='selected'><i class='fa fa-male'></i>Male</option>";
        }else{
            $str .= "<option value='Male'><i class='fa fa-male'></i>Male</option>";
        }
        
        
        $str .= "</select>";
        return $str;
    }
    
    
    static function regionDropdown($name){
        $str = "<select name='$name' onChange='districtDropdown(this)' id='region'>";
        $str .= "<option disabled='disabled' selected='selected'>Region</option>";
        $str .= "<option>Arusha</option><option>Dar es Saalam</option><option>Dodoma</option><option>Geita</option><option>Iringa</option>";
        $str .= "<option>Kagera</option><option>Katavi</option><option>Kigoma</option><option>Kilimanjaro</option><option>Lindi</option>";
        $str .= "<option>Manyara</option><option>Mara</option><option>Mbeya</option><option>Morogoro</option><option>Mtwara</option>";
        $str .= "<option>Mwanza</option><option>Njombe</option><option>Pwani</option><option>Rukwa</option><option>Ruvuma</option>";
        $str .= "<option>Shinyanga</option><option>Simiyu</option><option>Singida</option><option>Tabora</option><option>Tanga</option>";
        $str .= "</select>";
        return $str;
    }
    
     static function generalDropdown($name,$default,$array,$selected){
        $str = "<select name='$name' id='$name' class='form-control'echo >";
        $str .= "<option disabled='disabled' selected='selected'>$default</option>";
        foreach ($array as $value) {
            if($value == $selected)
                $str .= "<option value='{$value}' selected='selected'>$value</option>";
            else 
                $str .= "<option value='{$value}'>$value</option>";
        }
        //$str .= "<option>Option1</option><option>Option2</option><option>Option3</option><option>Option4</option><option>Option5</option>";
        $str .= "</select>";
        return $str;
    }
    
    
    static function regionalDropWithDefault($selected){
        $query = mysql_query("SELECT * FROM regions");
        $str = "<select name='region' id='region' class='form-control'>";
        $str .= "<option selected='selected'>Region</option>";
        while ($row = mysql_fetch_array($query)) {
            extract ($row);
            if($region == $selected){
              $str .= "<option selected='selected'>$region</option>";  
            }else{
               $str .= "<option>$region</option>"; 
            }
        }
        $str .= "</select>";
        return $str;
    }
    
    static function regionalMultWithDefault($selected){
        $query = mysql_query("SELECT * FROM regions");
        $str = "<select name='region' multiple='multiple' size='5'>";
        if(in_array("All Regions", $selected)){
            $str .= "<option selected='selected'>All Regions</option>";  
          }else{
             $str .= "<option>All Regions</option>"; 
          }
        while ($row = mysql_fetch_array($query)) {
            extract ($row);
            if(in_array($region, $selected)){
              $str .= "<option selected='selected'>$region</option>";  
            }else{
               $str .= "<option>$region</option>"; 
            }
        }
        $str .= "</select>";
        return $str;
    }
   
    static function districtDropdown($regi,$selected){
        $query = mysql_query("SELECT * FROM regions WHERE region='$regi'");
        $str = "";
        if($regi == "all"){
            $str.= "<select name='district' id='district' class='form-control'>";
            $str .= "<option selected='selected'>District</option>";
            $query1 = mysql_query("SELECT * FROM districts ORDER BY district");
            while ($row1 = mysql_fetch_array($query1)) {
                extract($row1);
                
                $str .=($district == $selected)?"<option selected='selected'>$district</option>":"<option>$district</option>";
            }
            $str .="</select>";
        }else{
        while ($row = mysql_fetch_array($query)) {
            extract($row);
            if($region == $regi){
                $str.= "<select name='district' id='district' class='form-control'>";
                $query1 = mysql_query("SELECT * FROM districts WHERE region_id=$id");
                while ($row1 = mysql_fetch_array($query1)) {
                    extract($row1);
                    $str .= "<option>$district</option>";
                }
                $str .="</select>";
            }
        }
        }
        return $str;
    }
    
    static function villageDropdown($regi){
        $query = mysql_query("SELECT * FROM regions WHERE region='$regi'");
        $str = "";
        if($regi == "all"){
            $str.= "<select name='village' id='village' class='form-control'>";
            $str .= "<option selected='selected'>Village</option>";
            $query1 = mysql_query("SELECT * FROM districts ORDER BY district");
            while ($row1 = mysql_fetch_array($query1)) {
                extract($row1);
                $str .= "<option>$district</option>";
            }
            $str .="</select>";
        }else{
        while ($row = mysql_fetch_array($query)) {
            extract($row);
            if($region == $regi){
                $str.= "<select name='village' id='village' class='form-control'>";
                $query1 = mysql_query("SELECT * FROM districts WHERE region_id=$id");
                while ($row1 = mysql_fetch_array($query1)) {
                    extract($row1);
                    $str .= "<option>$district</option>";
                }
                $str .="</select>";
            }
        }
        }
        return $str;
    }
    
    
    
    static function wardDropdown($regi){
        $query = mysql_query("SELECT * FROM regions WHERE region='$regi'");
        $str = "";
        if($regi == "all"){
            $str.= "<select  name='ward' id='ward'  class='form-control'>";
            $str .= "<option selected='selected'>Ward</option>";
            $query1 = mysql_query("SELECT * FROM districts ORDER BY district");
            while ($row1 = mysql_fetch_array($query1)) {
                extract($row1);
                $str .= "<option>$district</option>";
            }
            $str .="</select>";
        }else{
        while ($row = mysql_fetch_array($query)) {
            extract($row);
            if($region == $regi){
                $str.= "<select  name='ward' id='ward'  class='form-control'>";
                $query1 = mysql_query("SELECT * FROM districts WHERE region_id=$id");
                while ($row1 = mysql_fetch_array($query1)) {
                    extract($row1);
                    $str .= "<option>$district</option>";
                }
                $str .="</select>";
            }
        }
        }
        return $str;
    }
    
    static function countryList(){
        ?>
        <select name="nationality" id="nationality" class="form-control validate[required]">
        <option value="United States">United States</option>
        <option value="United Kingdom">United Kingdom</option>
        <option value="Afghanistan">Afghanistan</option>
        <option value="Albania">Albania</option>
        <option value="Algeria">Algeria</option>
        <option value="American Samoa">American Samoa</option>
        <option value="Andorra">Andorra</option>
        <option value="Angola">Angola</option>
        <option value="Anguilla">Anguilla</option>
        <option value="Antarctica">Antarctica</option>
        <option value="Antigua and Barbuda">Antigua and Barbuda</option>
        <option value="Argentina">Argentina</option>
        <option value="Armenia">Armenia</option>
        <option value="Aruba">Aruba</option>
        <option value="Australia">Australia</option>
        <option value="Austria">Austria</option>
        <option value="Azerbaijan">Azerbaijan</option>
        <option value="Bahamas">Bahamas</option>
        <option value="Bahrain">Bahrain</option>
        <option value="Bangladesh">Bangladesh</option>
        <option value="Barbados">Barbados</option>
        <option value="Belarus">Belarus</option>
        <option value="Belgium">Belgium</option>
        <option value="Belize">Belize</option>
        <option value="Benin">Benin</option>
        <option value="Bermuda">Bermuda</option>
        <option value="Bhutan">Bhutan</option>
        <option value="Bolivia">Bolivia</option>
        <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
        <option value="Botswana">Botswana</option>
        <option value="Bouvet Island">Bouvet Island</option>
        <option value="Brazil">Brazil</option>
        <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
        <option value="Brunei Darussalam">Brunei Darussalam</option>
        <option value="Bulgaria">Bulgaria</option>
        <option value="Burkina Faso">Burkina Faso</option>
        <option value="Burundi">Burundi</option>
        <option value="Cambodia">Cambodia</option>
        <option value="Cameroon">Cameroon</option>
        <option value="Canada">Canada</option>
        <option value="Cape Verde">Cape Verde</option>
        <option value="Cayman Islands">Cayman Islands</option>
        <option value="Central African Republic">Central African Republic</option>
        <option value="Chad">Chad</option>
        <option value="Chile">Chile</option>
        <option value="China">China</option>
        <option value="Christmas Island">Christmas Island</option>
        <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
        <option value="Colombia">Colombia</option>
        <option value="Comoros">Comoros</option>
        <option value="Congo">Congo</option>
        <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
        <option value="Cook Islands">Cook Islands</option>
        <option value="Costa Rica">Costa Rica</option>
        <option value="Cote D'ivoire">Cote D'ivoire</option>
        <option value="Croatia">Croatia</option>
        <option value="Cuba">Cuba</option>
        <option value="Cyprus">Cyprus</option>
        <option value="Czech Republic">Czech Republic</option>
        <option value="Denmark">Denmark</option>
        <option value="Djibouti">Djibouti</option>
        <option value="Dominica">Dominica</option>
        <option value="Dominican Republic">Dominican Republic</option>
        <option value="Ecuador">Ecuador</option>
        <option value="Egypt">Egypt</option>
        <option value="El Salvador">El Salvador</option>
        <option value="Equatorial Guinea">Equatorial Guinea</option>
        <option value="Eritrea">Eritrea</option>
        <option value="Estonia">Estonia</option>
        <option value="Ethiopia">Ethiopia</option>
        <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
        <option value="Faroe Islands">Faroe Islands</option>
        <option value="Fiji">Fiji</option>
        <option value="Finland">Finland</option>
        <option value="France">France</option>
        <option value="French Guiana">French Guiana</option>
        <option value="French Polynesia">French Polynesia</option>
        <option value="French Southern Territories">French Southern Territories</option>
        <option value="Gabon">Gabon</option>
        <option value="Gambia">Gambia</option>
        <option value="Georgia">Georgia</option>
        <option value="Germany">Germany</option>
        <option value="Ghana">Ghana</option>
        <option value="Gibraltar">Gibraltar</option>
        <option value="Greece">Greece</option>
        <option value="Greenland">Greenland</option>
        <option value="Grenada">Grenada</option>
        <option value="Guadeloupe">Guadeloupe</option>
        <option value="Guam">Guam</option>
        <option value="Guatemala">Guatemala</option>
        <option value="Guinea">Guinea</option>
        <option value="Guinea-bissau">Guinea-bissau</option>
        <option value="Guyana">Guyana</option>
        <option value="Haiti">Haiti</option>
        <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
        <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
        <option value="Honduras">Honduras</option>
        <option value="Hong Kong">Hong Kong</option>
        <option value="Hungary">Hungary</option>
        <option value="Iceland">Iceland</option>
        <option value="India">India</option>
        <option value="Indonesia">Indonesia</option>
        <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
        <option value="Iraq">Iraq</option>
        <option value="Ireland">Ireland</option>
        <option value="Israel">Israel</option>
        <option value="Italy">Italy</option>
        <option value="Jamaica">Jamaica</option>
        <option value="Japan">Japan</option>
        <option value="Jordan">Jordan</option>
        <option value="Kazakhstan">Kazakhstan</option>
        <option value="Kenya">Kenya</option>
        <option value="Kiribati">Kiribati</option>
        <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
        <option value="Korea, Republic of">Korea, Republic of</option>
        <option value="Kuwait">Kuwait</option>
        <option value="Kyrgyzstan">Kyrgyzstan</option>
        <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
        <option value="Latvia">Latvia</option>
        <option value="Lebanon">Lebanon</option>
        <option value="Lesotho">Lesotho</option>
        <option value="Liberia">Liberia</option>
        <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
        <option value="Liechtenstein">Liechtenstein</option>
        <option value="Lithuania">Lithuania</option>
        <option value="Luxembourg">Luxembourg</option>
        <option value="Macao">Macao</option>
        <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
        <option value="Madagascar">Madagascar</option>
        <option value="Malawi">Malawi</option>
        <option value="Malaysia">Malaysia</option>
        <option value="Maldives">Maldives</option>
        <option value="Mali">Mali</option>
        <option value="Malta">Malta</option>
        <option value="Marshall Islands">Marshall Islands</option>
        <option value="Martinique">Martinique</option>
        <option value="Mauritania">Mauritania</option>
        <option value="Mauritius">Mauritius</option>
        <option value="Mayotte">Mayotte</option>
        <option value="Mexico">Mexico</option>
        <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
        <option value="Moldova, Republic of">Moldova, Republic of</option>
        <option value="Monaco">Monaco</option>
        <option value="Mongolia">Mongolia</option>
        <option value="Montserrat">Montserrat</option>
        <option value="Morocco">Morocco</option>
        <option value="Mozambique">Mozambique</option>
        <option value="Myanmar">Myanmar</option>
        <option value="Namibia">Namibia</option>
        <option value="Nauru">Nauru</option>
        <option value="Nepal">Nepal</option>
        <option value="Netherlands">Netherlands</option>
        <option value="Netherlands Antilles">Netherlands Antilles</option>
        <option value="New Caledonia">New Caledonia</option>
        <option value="New Zealand">New Zealand</option>
        <option value="Nicaragua">Nicaragua</option>
        <option value="Niger">Niger</option>
        <option value="Nigeria">Nigeria</option>
        <option value="Niue">Niue</option>
        <option value="Norfolk Island">Norfolk Island</option>
        <option value="Northern Mariana Islands">Northern Mariana Islands</option>
        <option value="Norway">Norway</option>
        <option value="Oman">Oman</option>
        <option value="Pakistan">Pakistan</option>
        <option value="Palau">Palau</option>
        <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
        <option value="Panama">Panama</option>
        <option value="Papua New Guinea">Papua New Guinea</option>
        <option value="Paraguay">Paraguay</option>
        <option value="Peru">Peru</option>
        <option value="Philippines">Philippines</option>
        <option value="Pitcairn">Pitcairn</option>
        <option value="Poland">Poland</option>
        <option value="Portugal">Portugal</option>
        <option value="Puerto Rico">Puerto Rico</option>
        <option value="Qatar">Qatar</option>
        <option value="Reunion">Reunion</option>
        <option value="Romania">Romania</option>
        <option value="Russian Federation">Russian Federation</option>
        <option value="Rwanda">Rwanda</option>
        <option value="Saint Helena">Saint Helena</option>
        <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
        <option value="Saint Lucia">Saint Lucia</option>
        <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
        <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
        <option value="Samoa">Samoa</option>
        <option value="San Marino">San Marino</option>
        <option value="Sao Tome and Principe">Sao Tome and Principe</option>
        <option value="Saudi Arabia">Saudi Arabia</option>
        <option value="Senegal">Senegal</option>
        <option value="Serbia and Montenegro">Serbia and Montenegro</option>
        <option value="Seychelles">Seychelles</option>
        <option value="Sierra Leone">Sierra Leone</option>
        <option value="Singapore">Singapore</option>
        <option value="Slovakia">Slovakia</option>
        <option value="Slovenia">Slovenia</option>
        <option value="Solomon Islands">Solomon Islands</option>
        <option value="Somalia">Somalia</option>
        <option value="South Africa">South Africa</option>
        <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
        <option value="Spain">Spain</option>
        <option value="Sri Lanka">Sri Lanka</option>
        <option value="Sudan">Sudan</option>
        <option value="Suriname">Suriname</option>
        <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
        <option value="Swaziland">Swaziland</option>
        <option value="Sweden">Sweden</option>
        <option value="Switzerland">Switzerland</option>
        <option value="Syrian Arab Republic">Syrian Arab Republic</option>
        <option value="Taiwan, Province of China">Taiwan, Province of China</option>
        <option value="Tajikistan">Tajikistan</option>
        <option value="Tanzania, United Republic of" selected="selected">Tanzania, United Republic of</option>
        <option value="Thailand">Thailand</option>
        <option value="Timor-leste">Timor-leste</option>
        <option value="Togo">Togo</option>
        <option value="Tokelau">Tokelau</option>
        <option value="Tonga">Tonga</option>
        <option value="Trinidad and Tobago">Trinidad and Tobago</option>
        <option value="Tunisia">Tunisia</option>
        <option value="Turkey">Turkey</option>
        <option value="Turkmenistan">Turkmenistan</option>
        <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
        <option value="Tuvalu">Tuvalu</option>
        <option value="Uganda">Uganda</option>
        <option value="Ukraine">Ukraine</option>
        <option value="United Arab Emirates">United Arab Emirates</option>
        <option value="United Kingdom">United Kingdom</option>
        <option value="United States">United States</option>
        <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
        <option value="Uruguay">Uruguay</option>
        <option value="Uzbekistan">Uzbekistan</option>
        <option value="Vanuatu">Vanuatu</option>
        <option value="Venezuela">Venezuela</option>
        <option value="Viet Nam">Viet Nam</option>
        <option value="Virgin Islands, British">Virgin Islands, British</option>
        <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
        <option value="Wallis and Futuna">Wallis and Futuna</option>
        <option value="Western Sahara">Western Sahara</option>
        <option value="Yemen">Yemen</option>
        <option value="Zambia">Zambia</option>
        <option value="Zimbabwe">Zimbabwe</option>
        </select>
       <?php
    } 
    
    static function countryArray(){
        
        return array(
        "Tanzania, United Republic of","United States","United Kingdom","Afghanistan","Albania","Algeria","American Samoa","Andorra","Angola","Anguilla","Antarctica",
        "Antigua and Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados",
        "Belarus","Belgium","Belize","Benin","Bermuda","Bhutan",
        "Bolivia",
        "Bosnia and Herzegovina",
        "Botswana",
        "Bouvet Island",
        "Brazil",
        "British Indian Ocean Territory",
        "Brunei Darussalam",
        "Bulgaria",
        "Burkina Faso",
        "Burundi",
        "Cambodia",
        "Cameroon",
        "Canada",
        "Cape Verde",
        "Cayman Islands",
        "Central African Republic",
        "Chad",
        "Chile",
        "China",
        "Christmas Island",
        "Cocos (Keeling) Islands",
        "Colombia",
        "Comoros",
        "Congo",
        "Congo, The Democratic Republic of The",
        "Cook Islands",
        "Costa Rica",
        "Cote D'ivoire",
        "Cote D'ivoire",
        "Croatia",
        "Cuba",
        "Cyprus",
        "Czech Republic",
        "Denmark",
        "Djibouti",
        "Dominica",
        "Dominican Republic",
        "Ecuador",
        "Egypt",
        "El Salvador",
        "Equatorial Guinea",
        "Eritrea",
        "Estonia",
        "Ethiopia",
        "Falkland Islands (Malvinas)",
        "Faroe Islands",
        "Fiji",
        "Finland",
        "France",
        "French Guiana",
        "French Polynesia",
        "French Southern Territories",
        "Gabon",
        "Gambia",
        "Georgia",
        "Germany",
        "Ghana",
        "Gibraltar",
        "Greece",
        "Greenland",
        "Grenada",
        "Guadeloupe",
        "Guam",
        "Guatemala",
        "Guinea",
        "Guinea-bissau",
        "Guyana",
        "Haiti",
        "Heard Island and Mcdonald Islands",
        "Holy See (Vatican City State)",
        "Honduras",
        "Hong Kong",
        "Hungary",
        "Iceland",
        "India",
        "Indonesia",
        "Iran, Islamic Republic of",
        "Iraq",
        "Ireland",
        "Israel",
        "Italy",
        "Jamaica",
        "Japan",
        "Jordan",
        "Kazakhstan",
        "Kenya",
        "Kiribati",
        "Korea, Democratic People's Republic of",
        "Korea, Republic of",
        "Kuwait",
        "Kyrgyzstan",
        "Lao People's Democratic Republic",
        "Latvia",
        "Lebanon",
        "Lesotho",
        "Liberia",
        "Libyan Arab Jamahiriya",
        "Liechtenstein",
        "Lithuania",
        "Luxembourg",
        "Macao",
        "Macedonia, The Former Yugoslav Republic of",
        "Malawi",
        "Malaysia",
        "Maldives",
        "Mali",
        "Malta",
        "Marshall Islands",
        "Martinique",
        "Mauritania",
        "Mauritius",
        "Mayotte",
        "Mexico",
        "Micronesia, Federated States of",
        "Moldova, Republic of",
        "Monaco",
        "Mongolia",
        "Montserrat",
        "Morocco",
        "Mozambique",
        "Myanmar",
        "Namibia",
        "Nauru",
        "Nepal",
        "Netherlands",
        "Netherlands Antilles",
        "New Caledonia",
        "New Zealand",
        "Nicaragua",
        "Niger",
        "Nigeria",
        "Niue",
        "Norfolk Island",
        "Northern Mariana Islands",
        "Norway",
        "Oman",
        "Pakistan",
        "Palau",
        "Palestinian Territory, Occupied",
        "Panama",
        "Papua New Guinea",
        "Paraguay",
        "Peru",
        "Philippines",
        "Pitcairn",
        "Poland",
        "Portugal",
        "Puerto Rico",
        "Qatar",
        "Reunion",
        "Romania",
        "Russian Federation",
        "Rwanda",
        "Saint Helena",
        "Saint Kitts and Nevis",
        "Saint Lucia",
        "Saint Pierre and Miquelon",
        "Saint Vincent and The Grenadines",
        "Samoa",
        "San Marino",
        "Sao Tome and Principe",
        "Saudi Arabia",
        "Senegal",
        "Serbia and Montenegro",
        "Seychelles",
        "Sierra Leone",
        "Singapore",
        "Slovakia",
        "Slovenia",
        "Solomon Islands",
        "Somalia",
        "South Africa",
        "South Georgia and The South Sandwich Islands",
        "Spain",
        "Sri Lanka",
        "Sudan",
        "Suriname",
        "Svalbard and Jan Mayen",
        "Swaziland",
        "Sweden",
        "Switzerland",
        "Syrian Arab Republic",
        "Taiwan, Province of China",
        "Tajikistan",
        "Thailand",
        "Timor-leste",
        "Togo",
        "Tokelau",
        "Tonga",
        "Trinidad and Tobago",
        "Tunisia",
        "Turkey",
        "Turkmenistan",
        "Turks and Caicos Islands",
        "Tuvalu",
        "Uganda",
        "Ukraine",
        "United Arab Emirates",
        "United Kingdom",
        "United States",
        "United States Minor Outlying Islands",
        "Uruguay",
        "Uzbekistan",
        "Vanuatu",
        "Venezuela",
        "Viet Nam",
        "Virgin Islands, British",
        "Virgin Islands, U.S.",
        "Wallis and Futuna",
        "Western Sahara",
        "Yemen",
        "Zambia",
        "Zimbabwe"
            );
       
    }
    
    static function tribesList(){
        ?>
  <select name="tribe" id="tribe" class="form-control">
      <option selected="selected" disabled="disabled">Select Tribe</option>     
    <option>Alagwa</option>
    <option>Akiek</option>
    <option>Arusha</option>
    <option>Assa</option>
    <option>Barabaig</option>
    <option>Bembe</option>
    <option>Bena</option>
    <option>Bende</option>
    <option>Bondei</option>
    <option>Bungu</option>
    <option>Burunge</option>
    <option>Chaga</option>
    <option>Datooga</option>
    <option>Dhaiso</option>
    <option>Digo</option>
    <option>Doe</option>
    <option>Fipa</option>
    <option>Gogo</option>
    <option>Gorowa</option>
    <option>Gweno</option>
    <option>Ha</option>
    <option>Hadza</option>
    <option>Hangaza</option>
    <option>Haya</option>
    <option>Hehe</option>
    <option>Ikizu</option>
    <option>Ikoma</option>
    <option>Iraqw</option>
    <option>Isanzu</option>
    <option>Jiji</option>
    <option>Jita</option>
    <option>Kabwa</option>
    <option>Kagura</option>
    <option>Kaguru</option>
    <option>Kahe</option>
    <option>Kami</option>
    <option>Kara (also called <i>Regi</i>)</option>
    <option>Kerewe</option>
    <option>Kimbu</option>
    <option>Kinga</option>
    <option>Kisankasa</option>
    <option>Kisi</option>
    <option>Konongo</option>
    <option>Kuria</option>
    <option>Kutu</option>
    <option>Kw'adza</option>
    <option>Kwavi</option>
    <option>Kwaya</option>
    <option>Kwere</option>
    <option>Kwifa</option>
    <option>Lambya</option>
    <option>Luguru</option>
    <option>Luo</option>
    <option>Maasai</option>
    <option>Machinga</option>
    <option>Magoma</option>
    <option>Makonde</option>
    <option>Makua</option>
    <option>Makwe</option>
    <option>Malila</option>
    <option>Mambwe</option>
    <option>Manda</option>
    <option>Matengo</option>
    <option>Matumbi</option>
    <option>Maviha</option>
    <option>Mbugwe</option>
    <option>Mbunga</option>
    <option>Meru (Wameru of the slopes of Mt. Meru in Arumeru District)</option>
    <option>Mosiro</option>
    <option>Mpoto</option>
    <option>Mwanga</option>
    <option>Mwera</option>
    <option>Ndali</option>
    <option>Ndamba</option>
    <option>Ndendeule</option>
    <option>Ndengereko</option>
    <option>Ndonde</option>
    <option>Ngasa</option>
    <option>Ngindo</option>
    <option>Ngoni</option>
    <option>Ngulu</option>
    <option>Ngurimi</option>
    <option>Ngwele</option>
    <option>Nilamba</option>
    <option>Nindi</option>
    <option>Nyakyusa</option>
    <option>Nyambo</option>
    <option>Nyamwanga</option>
    <option>Nyamwezi</option>
    <option>Nyanyembe</option>
    <option>Nyaturu</option>
    <option>Nyiha</option>
    <option>Nyiramba</option>
    <option>Pangwa</option>
    <option>Pare</option>
    <option>Pimbwe</option>
    <option>Pogolo</option>
    <option>Rangi</option>
    <option>Rufiji</option>
    <option>Rungi</option>
    <option>Rungu</option>
    <option>Rungwa</option>
    <option>Rwa</option>
    <option>Safwa</option>
    <option>Sagara</option>
    <option>Sandawe</option>
    <option>Sangu</option>
    <option>Segeju</option>
    <option>Shambaa</option>
    <option>Shirazi</option>
    <option>Shubi</option>
    <option>Sizaki</option>
    <option>Suba</option>
    <option>Sukuma</option>
    <option>Sumbwa</option>
    <option>Swahili</option>
    <option>Temi</option>
    <option>Tongwe</option>
    <option>Tumbuka</option>
    <option>Vidunda</option>
    <option>Vinza</option>
    <option>Wanda</option>
    <option>Wanji</option>
    <option>Ware</option>
    <option>Yao</option>
    <option>Zanaki</option>
    <option>Zaramo</option>
    <option>Zigula</option>
    <option>Zinza</option>
    <option>Zyoba</option>
</select>
       <?php
    }

    
}

?>
