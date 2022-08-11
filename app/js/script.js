

document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.carousel');
	var options = {
		fullWidth: true,
		indicators: true
	  };
	M.Carousel.init(elems, options);
  });

document.addEventListener("DOMContentLoaded", function () {
	var elems = document.querySelectorAll(".sidenav");
	var options = { hover: true };
	var instances = M.Sidenav.init(elems, options);
});



  document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('#dropdowner');
    var instances = M.Dropdown.init(elems);
  });

  document.addEventListener('DOMContentLoaded', function() {
    var modal = document.querySelectorAll('.modal');
    var instances_modal = M.Modal.init(modal);
	var collapsible = document.querySelectorAll('.collapsible');
	var instances_collapsible = M.Collapsible.init(collapsible);
  });
  
  document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('select');
    var instances = M.FormSelect.init(elems);
  });
// M.AutoInit();
