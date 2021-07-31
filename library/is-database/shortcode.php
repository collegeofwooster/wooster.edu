<?php


// the is-search shortcode
function is_search_shortcode() {
	$is_search = <<<EOT
	<script>

	function checkEnter(e, textarea){
		var code = (e.keyCode ? e.keyCode : e.which);
		if(code == 13) {
			grabResults();
		}
	}

	function grabResults() {
		var name = document.getElementById('is-search-name').value;
		var year = document.getElementById('is-search-year').value;
		var istitle = document.getElementById('is-search-title').value;
		var major = document.getElementById('is-search-major').value;
		var advisor = document.getElementById('is-search-advisor').value;

		if ( name.length==0 && year.length==0 && istitle.length==0 && major.length==0 && advisor.length==0 ) { 
			document.getElementById("errortext").innerHTML="At least 1 field is required.";
			return;
		}

		var xmlhttp=new XMLHttpRequest();
		xmlhttp.onreadystatechange=function() {
			if ( xmlhttp.readyState==4 && xmlhttp.status==200 ) {
				document.getElementById("is-results").innerHTML=xmlhttp.responseText;
				$('tr:nth-child(odd)').addClass("odd");
			}
		}
		xmlhttp.open("GET","/wp-content/themes/wooster/library/is-database/database-query.php?n=" + name + "&y=" + year + "&t=" +istitle + "&m=" + major + "&a=" + advisor,true);
		xmlhttp.send();
	}

	</script>
	<div id="is-search-div" class="is-search">
		<div>Student Last: <br><input id="is-search-name" type="text" onkeypress="checkEnter(event, this)"></div>
		<div>Year: <br><input id="is-search-year" type="text" onkeypress="checkEnter(event, this)"></div>
		<div>I.S. Title: <br><input id="is-search-title" type="text" onkeypress="checkEnter(event, this)"></div>
		<div>Major: <br>
			<!--<input id="is-search-major" type="text" onkeypress="checkEnter(event, this)" />-->
			<select id="is-search-major" onkeypress="checkEnter(event, this)">
				<option selected value="">None</option>
				<option value="AFST">Africana Studies (AFST)</option>
				<option value="AAS">Afro American Studies (AAS)</option>
				<option value="ANTH">Anthropology (ANTH)</option>
				<option value="ARCH">Archaeology (ARCH)</option>
				<option value="ARC">Archaeology (ARC)</option>
				<option value="ART">Art (ART)</option>
				<option value="ARTH">Art History (ARTH)</option>
				<option value="ARH">Art History (ARH)</option>
				<option value="ARTS">Fine Arts (ARTS)</option>
				<option value="BCHM">Biochemistry (BCHM)</option>
				<option value="BCH">Biochemistry (BCH)</option>
				<option value="B%26MB">Biochemistry and Molecular Biology (B&amp;MB)</option>
				<option value="BMB">Biochemistry and Molecular Biology (BMB)</option>
				<option value="BIOL">Biology (BIOL)</option>
				<option value="BLST">Black Studies (BLST)</option>
				<option value="BUS">Business (BUS)</option>
				<option value="BUEC">Business Economics (BUEC)</option>
				<option value="CAST">Cultural Area Studies (CAST)</option>
				<option value="CAS">Cultural Area Studies (CAS)</option>
				<option value="CHEM">Chemistry (CHEM)</option>
				<option value="CHIN">Chinese (CHIN)</option>
				<option value="CHPY">Chemical Physics (CHPY)</option>
				<option value="CLST">Classical Studies (CLST)</option>
				<option value="CMLT">Comparative Literature (CMLT)</option>
				<option value="COM">Communication (COM)</option>
				<option value="COMD">Communication Sciences and Disorders (COMD)</option>
				<option value="COMS">Communication Studies (COMS)</option>
				<option value="CSCI">Computer Science (CSCI)</option>
				<option value="EAST">East Asian Studies (EAST)</option>
				<option value="ECON">Economics (ECON)</option>
				<option value="EDUC">Education (EDUC)</option>
				<option value="ENGL">English (ENGL)</option>
				<option value="FREN">French and Francophone Studies (FREN)</option>
				<option value="GLI">General Literature (GLI)</option>
				<option value="GEOL">Geology (GEOL)</option>
				<option value="GERS">German (GERS)</option>
				<option value="GERL">German Language and Literature (GERL)</option>
				<option value="GKL">Greek and Latin (GKL)</option>
				<option value="HIST">History (HIST)</option>
				<option value="INDN">Indian Studies (INDN)</option>
				<option value="INRE">International Relations (INRE)</option>
				<option value="JRN">Journalism (JRN)</option>
				<option value="MATH">Mathematics (MATH)</option>
				<option value="MUSC">Music (MUSC)</option>
				<option value="MUED">Music Education (MUED)</option>
				<option value="MUHL">Music History and Literature (MUHL)</option>
				<option value="MUSP">Music Performance (MUSP)</option>
				<option value="MUTC">Music Theory and Composition (MUTC)</option>
				<option value="MUTH">Musical Therapy (MUTH)</option>
				<option value="NEUR">Neuroscience (NEUR)</option>
				<option value="PHIL">Philosophy (PHIL)</option>
				<option value="PED">Physical Education (PED)</option>
				<option value="PHYS">Physics (PHYS)</option>
				<option value="PSCI">Political Science (PSCI)</option>
				<option value="PSYC">Psychology (PSYC)</option>
				<option value="RELS">Religious Studies (RELS)</option>
				<option value="RUSS">Russian Studies (RUSS)</option>
				<option value="SOCI">Sociology (SOCI)</option>
				<option value="SOCA">Sociology - Anthropology Track (SOCA)</option>
				<option value="SOCG">Sociology - General Track (SOCG)</option>
				<option value="SOCW">Sociology - Welfare Track (SOCW)</option>
				<option value="SPAN">Spanish (SPAN)</option>
				<option value="SPCH">Speech (SPCH)</option>
				<option value="SPEC">Student Designed Major (SPEC)</option>
				<option value="THTD">Theatre - Dance (THTD)</option>
				<option value="THTR">Theatre (THTR)</option>
				<option value="URBN">Urban Studies (URBN)</option>
				<option value="WGSS">Women's, Gender, and Sexuality Studies (WGSS)</option>
				<option value="WOMN">Women's Studies (WOMN)</option>
			</select>
		</div>
		<div>Advisor Last: <br><input id="is-search-advisor" type="text" onkeypress="checkEnter(event, this)"></div>
		<div class='button-container'><input id="is-submit" class="btn gold" type="button" value="Search" onclick="grabResults()"></div>
	</div>
	<div id="is-results">
		<table id="is-table" class="dataTable">
			<tbody>
			<tr>
				<th>Student</th>
				<th>Year</th>
				<th>I.S. Title</th>
				<th nowrap>Major 1</th>
				<th nowrap>Major 2</th>
				<th>Advisor</th>
			</tr>
			<tr>
				<td colspan="6" align="center" valign="center"><span id="errortext"><span style="color: black;">Please search to view results</span></span></td>
			</tr>
			</tbody>
		</table>
	</div>
	EOT;
	return $is_search;
}
add_shortcode( 'is-search', 'is_search_shortcode' );


