$(document).ready(function(){

	var buildHeaderOrCreateUL = function (list, cage, part, serial) {

		for (var i in list)
			var id = i; // each list should have only one item until the selected item
				
		if (list[id].CAGE == cage && list[id].PART_NUMBER == part && list[id].S_N == serial) {
			// return $("<div class='ims-target-cagePartSerial-item'>")
				// .text( getCanonicalName(list[id]) )
				// .after( createUL( list[id].CHILDREN ) );
			return getItemName(list[id], "ims-target-cagePartSerial-item ims-display-name")
				.after( createUL( list[id].CHILDREN ) );
		}
		else {
			var locationPart = list[id].LOCATION_PART ? list[id].LOCATION_PART : "";
			return $("<span class='ims-location-part'>")
				.text( locationPart )
				.after( buildHeaderOrCreateUL(list[id].CHILDREN, cage, part, serial) );
		}
		
	};
	
	// gets the priority order for naming...
	var getCanonicalName = function(item) {
		var nameOptions = ["ACRONYM","E_OPS","R_OPS","PART_NUMBER","S_N"];
		var name;
		for(var n in nameOptions) {
			if (item[nameOptions[n]]) {
				name = item[nameOptions[n]];
				break;
			}
		}
		return name ? name : "no title!";
	}
	
	var getItemName = function(item, className) {
	
		var moreInfo = getItemInfoTable(item);
	
		return $("<div class='" + className + "'>")
			.text( getCanonicalName(item) )
			.append(
				$("<span class='ims-serial-number-display'>").text(item.S_N)
			)
			.click(function(clickEvent){
				clickEvent.stopPropagation(); // don't apply click to elements higher in DOM
				$(this).parent().find(".ims-more-info").first().toggle(800); // for some reason this easing works only sometimes: "easeOutExpo"
				return false;
			})
			.after( moreInfo );
	
	};
	
	var getItemInfoTable = function(item) {
	
		var addRow = function(label, data) {
			data = data ? data : "";
			return $("<tr>")
				.append(
					$("<td class='ims-data-label'>").text(label)
				)
				.append(
					$("<td>").text(data)
				);
		}

	
		return $("<div class='ims-more-info'>")
			.append(
				$("<table>").append(
					addRow("Part Number", item.PART_NUMBER),
					addRow("S/N", item.S_N),
					addRow("Cage Code", item.CAGE),
					addRow("Acronym", item.ACRONYM),
					addRow("English Name", item.E_OPS),
					addRow("Russian Name", item.R_OPS),
					addRow("Barcode", item.BARCODE),
					addRow("Label", item.LABEL),
					addRow("Length (mm)", item.LENGTH),
					addRow("Width (mm)", item.WIDTH),
					addRow("Height (mm)", item.HEIGHT),
					addRow("Diameter (mm)", item.DIAMETER),
					addRow("Volume (mm)", item.VOLUME),
					addRow("Weight (kg)", item.WEIGHT),
					addRow("Launch", item.LAUNCH)
				)
			);
	};

	var createUL = function (list, partnumber) {

		var out = [];
	 
		for(var id in list) {
		
			var pnClass = (list[id].PART_NUMBER == partnumber) ? "ims-display-name ims-target-partnumber" : "ims-display-name";
					 	
			out.push(
				$("<li>")
					.append( getItemName(list[id], pnClass) )
					.append( createUL( list[id].CHILDREN, partnumber ) )
			);
	 
		}
	 
		return $("<ul>").append(out);
	 
	};

	$(".ims-part-number-search").each(function(index,element){

		var partnumber = $(element).find(".ims-partnumber").html().trim();
	
		$.getJSON(
			"https://mod-dev2.jsc.nasa.gov/wiki/extensions/IMS/API.asmx/GetFullTreeByPartNumber",
			{
				PartNumber : partnumber
			},
			function(response) {
				for(var id in response) {
					if ( ! (id == "0" || id == "1") )
						delete response[id]; // remove items not in ISS or LOST trees
				}
			
				$(element).html( createUL(response, partnumber) );
			}
		);

	});
	
	
	$(".ims-item-search").each(function(index,element){

		var cagecode     = $(element).find(".ims-cagecode").html().trim();
		var partnumber   = $(element).find(".ims-partnumber").html().trim();
		var serialnumber = $(element).find(".ims-serialnumber").html().trim();
	
		$.getJSON(
			"https://mod-dev2.jsc.nasa.gov/wiki/extensions/IMS/API.asmx/GetFullTreeByCagePartSerial",
			{
				CageCode : cagecode,
				PartNumber : partnumber,
				SerialNumber : serialnumber
			},
			function(response) {			
				$(element).html( buildHeaderOrCreateUL(response, cagecode, partnumber, serialnumber) );
			}
		);

	});
	
});