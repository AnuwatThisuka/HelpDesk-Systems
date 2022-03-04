function genPDF() {
  var doc = new jsPDF();

  var specialElementHandlers = {
    "#test2": function (element, render) {
      return true;
    },
  };

  doc.fromHTML($("#test").get(0), 20, 20, {
    width: 500,
    elementHandlers: specialElementHandlers,
  });

  doc.save("Test.pdf");
}
