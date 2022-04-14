function printReport(htmlContent) {
    var newWin=window.open('','Print-Window');
    newWin.document.open();
    newWin.document.write(htmlContent);
    newWin.print();
    newWin.document.close();
    setTimeout(function(){newWin.close();},10);
}
