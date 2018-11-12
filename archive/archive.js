async function load_default_entries() {

}

var selected_tags = [];
var archive = null;

function restyle_tags() {
	$(".tag").each(function (i, value) {
		var tag_name = $(this).attr("data-tag-name");
		if(selected_tags.includes(tag_name)) {
			this.classList.add("tag_selected");
		}
		else {
			this.classList.remove("tag_selected");
		}
	});
}

function toggle_tag(tag_name) {
	if(selected_tags.includes(tag_name)) {
		//remove all which match
		selected_tags = selected_tags.filter(selected_tag => selected_tag != tag_name);
	}
	else {
		//add it
		selected_tags.push(tag_name);
	}

	present_archive();
	restyle_tags();
}

function toggle_tag_element(args) {
	var tag_name = $(this).attr("data-tag-name");
	toggle_tag(tag_name);
	return false; // cancel the a href action
}

function draw_tag(tag_name) {
	var element = $(`<a class="tag" href="#" data-tag-name="${tag_name}">${tag_name}</a>`);
	element.click(toggle_tag_element);
	return element;
}

async function load_tag_editor() {
	var tags = await $.getJSON("get_tags.php");
	for(var tag_category in tags) {
		var tag_category_element = $(`<div class="tag_category"></div>`);
		$("#tag_cloud").append(tag_category_element);
		var tag_category_header_element = $(`<span class="tag_category_title">${tag_category}</span>`);
		tag_category_element.append(tag_category_header_element);

		for(var tag_name_index in tags[tag_category]) {
			var tag_name = tags[tag_category][tag_name_index];
			var tag_element = draw_tag(tag_name);
			tag_category_element.append(tag_element);
		}
	}
}



function draw_archive_item(path, description) {
	var archive_item_element = $(`<div class="archive_item" data-path="${path}"></div>`);

	var date = new Date(description['date']);
	var year = date.getFullYear();
	var month = date.getMonth() + 1;
	var day = date.getDate();

	var date_element = $(`<span class="text_en_bold">${year}. ${month}. ${day}</span>`);
	archive_item_element.append(date_element);

	archive_item_element.append($(`<br />`));

	archive_item_element.append(description[`title`]);

	archive_item_element.append($(`<br />`));


	// Tags
	{
		var archive_item_tags_element = $(`<div class="archive_item_tags"></div>`);
		for(var tag_index in description['tags']) {
			var tag_name = description['tags'][tag_index];
			var tag_element = draw_tag(tag_name);
			archive_item_tags_element.append(tag_element);
		}
		archive_item_element.append(archive_item_tags_element);
	}

	// Content
	{
		if('records' in description) {
			var records_list_element = $('<ol class="archive_records"><p></p></ol>');
			for(var index in description['records']) {
				var record = description['records'][index];

				var icon_string = "";
				var link_url = "";

				var screenshot_url = null;

				switch(record['type']) {
					case 'image':
						icon_string = `<i class="fas fa-image"></i>`;
						link_url = "/archive" + path + "/" + record['file'];
						break;
					case 'pdf':
						icon_string = `<i class="fas fa-file-pdf"></i>`;
						link_url = "/archive" + path + "/" + record['file'];
						break;
					case 'link':
						icon_string = `<i class="fas fa-external-link-alt"></i>`;
						link_url = record['url'];

						if('screenshot' in record) {
							screenshot_url = "/archive" + path + "/" + record['screenshot'];
						}
						break;
					default:
						break;
				}
/*
				var ancillary = "";
				if(screenshot_url != null) {
					ancillary = `&nbsp; Screenshot : <a href="${screenshot_url}" class="hoverGrey" target="_blank"><i class="fas fa-desktop"></i></a>`
				}
*/

				var ancillary = "";
				if(screenshot_url != null) {
					ancillary = `&nbsp;| <i class="fas fa-desktop"></i> <a href="${screenshot_url}" class="hoverGrey" target="_blank">Screenshot</a>`
				}

				var record_element = $(`<li class="archive_record_entry"> ${icon_string} <span class="press-link"><a href="${link_url}" class="hoverGrey" target="_blank"> ${record['name']}</a>${ancillary}</span></li>`);
				records_list_element.append(record_element);
			}

			archive_item_element.append(records_list_element);
		}
	}
	

	archive_item_element.append(`
			<div class="padding-60"></div>
			<div class="padding-1"></div> 
			<div class="padding-60"></div>
	`);

	return archive_item_element;
}

function draw_archive(archive, tags) {
	var archive_element = $("<div></div>");

	var current_year = null;
	var current_year_element = null;
	for(path in archive) {
		var description = archive[path];

		// Test tags if we need to 
		if(tags != null && tags.length != 0) {
			// Skip early if this entry doesn't have tags
			if(!('tags' in description)) {
				continue;
			}

			var missing_tag = false;

			for(var tag_test_index in tags) {
				var tag_text = tags[tag_test_index];
				if(!description['tags'].includes(tag_text)) {
					//skip
					missing_tag = true;
					break;
				}
			}

			if(missing_tag) {
				continue;
			}
		}
		

		// Check if the year has changed
		{
			var date = new Date(description['date']);
			var year = date.getFullYear();
			if(year != current_year) {
				//it's changed

				//open year
				archive_element.append(
					/*`
				<div class="description_nobg">
					<div class="description_title">
						<span class="text_en_bold"><div id="year_number">${year}</div></span> 
					</div>
				</div>`*/);
			
				var current_year_outer_element = $(`<div id="${year}" class="year_detail description_detail"></div>`);
				archive_element.append(current_year_outer_element);

				current_year_element = $(`<div class="text_description_detail">`);
				current_year_outer_element.append(current_year_element);

				current_year = year;
			}
		}
	
		
		var archive_item_element = draw_archive_item(path, description);
		current_year_element.append(archive_item_element);
	}

	return archive_element;
}

function present_archive() {
	var archive_container = $("#archive_container");

	//clear existing items
	archive_container.empty();
	var archive_element = draw_archive(archive, selected_tags);
	archive_container.append(archive_element);
}

async function prepare_archive() {
	archive = await $.getJSON(`get_entries.php`);

	load_default_entries();
	load_tag_editor();
	present_archive([]);
}

$(document).ready(() => {
	prepare_archive();
	restyle_tags();
});

