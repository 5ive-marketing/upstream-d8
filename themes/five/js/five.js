jQuery(document).ready(function(){
  jQuery('.table').each(function(){
    table = jQuery(this);
    tableRow = table.find('tr');
    table.find('td').each(function(){
      tdIndex = jQuery(this).index();
      if (jQuery(tableRow).find('th').eq(tdIndex).attr('data-label')) {
        thText = jQuery(tableRow).find('th').eq(tdIndex).data('label');
      } else {
        thText = jQuery(tableRow).find('th').eq(tdIndex).text();
      }
      jQuery(this).attr('data-label', thText + ':');
    });
  });
});


//var color = jQuery( ".field--name-field-background-color" ).text();
//jQuery( ".field--name-field-background-color" ).closest(".background").css({"background-color": color});
// jQuery(".field--name-field-background-color").hide();

// jQuery('.field--name-field-color').each(function(i, obj) {
//   var color = jQuery(this).text();
//   jQuery(this).closest(".background").addClass(color);
// });

jQuery( ".field--name-field-background-color" ).each(function(){
    var color = jQuery(this).text();
    jQuery(this).closest(".background").css({"background-color": color});
});