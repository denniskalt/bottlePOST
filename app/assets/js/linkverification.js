function verifyLink(source) {

    deselectAll();

    switch(source) {

       case "home":
           $("#a_home").addClass("active");
           break;
       case "about":
           $("#a_about").addClass("active");
           break;
       case "services":
           $("#a_services").addClass("active");
           break;
       case "portfolio":
           $("#a_portfolio").addClass("active");
           break;
       case "loc":
           $("#a_loc").addClass("active");
           break;
       case "contact":
           $("#a_contact").addClass("active");
           break;

   }

}

function deselectAll() {
    $("#a_home").removeClass("active");
    $("#a_about").removeClass("active");
    $("#a_services").removeClass("active");
    $("#a_portfolio").removeClass("active");
    $("#a_loc").removeClass("active");
    $("#a_contact").removeClass("active");
}
