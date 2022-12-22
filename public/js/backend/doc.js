
//sales history PDF download
function generateSalesHistoryReportPDF() {
    var doc = new jsPDF('p', 'pt', 'letter');
    var htmlstring = '';
    var tempVarToCheckPageHeight = 0;
    var pageHeight = 0;
    pageHeight = doc.internal.pageSize.height;
    specialElementHandlers = {
        // element with id of "bypass" - jQuery style selector
        '#bypassSalesHistory': function(element, renderer) {
            // true = "handled elsewhere, bypass text extraction"
            return true
        }
    };
    margins = {
        top: 150,
        bottom: 60,
        left: 40,
        right: 40,
        width: 600
    };
    var y = 20;
    doc.setLineWidth(2);
    doc.text(200, y = y + 10, "Sales History Report Page");
    doc.autoTable({
        html: '#view_salesHistoryReport_page',

    })
    doc.save('sales_history_report.pdf');
}

//Sales history Excel download
function generateSalesHistoryReportExcel(){
    var salesHistoryReportExcel = new Table2Excel('#view_salesHistoryReport_page', {
        filename: "sales_history_report"
    });

    salesHistoryReportExcel.export();
}





//payment PDF download
function generatePaymentsReportPDF() {
    var doc = new jsPDF('p', 'pt', 'letter');
    var htmlstring = '';
    var tempVarToCheckPageHeight = 0;
    var pageHeight = 0;
    pageHeight = doc.internal.pageSize.height;
    specialElementHandlers = {
        // element with id of "bypass" - jQuery style selector
        '#bypassPayments': function(element, renderer) {
            // true = "handled elsewhere, bypass text extraction"
            return true
        }
    };
    margins = {
        top: 150,
        bottom: 60,
        left: 40,
        right: 40,
        width: 600
    };
    var y = 20;
    doc.setLineWidth(2);
    doc.text(200, y = y + 10, "Sales Report Page");
    doc.autoTable({
        html: '#view_PaymentsReport_page',

    })
    doc.save('Payment_report.pdf');
}

//Payments Excel download
function generatePaymentsReportExcel(){
    var paymentsReportExcel = new Table2Excel('#view_PaymentsReport_page', {
        filename: "payment_report"
    });

    paymentsReportExcel.export();
}


//Product supplied PDF download
function generateProductSuppliedReportPDF() {
    var doc = new jsPDF('p', 'pt', 'letter');
    var htmlstring = '';
    var tempVarToCheckPageHeight = 0;
    var pageHeight = 0;
    pageHeight = doc.internal.pageSize.height;
    specialElementHandlers = {
        // element with id of "bypass" - jQuery style selector
        '#bypassProductSupplied': function(element, renderer) {
            // true = "handled elsewhere, bypass text extraction"
            return true
        }
    };
    margins = {
        top: 150,
        bottom: 60,
        left: 40,
        right: 40,
        width: 600
    };
    var y = 20;
    doc.setLineWidth(2);
    doc.text(200, y = y + 10, "Product Supplied Report Page");
    doc.autoTable({
        html: '#view_productsSuppliedReport_page',

    })
    doc.save('product_supplied_report.pdf');
}

//Product supplied Excel download
function generateProductSuppliedReportExcel(){
    var productSuppliedReportExcel = new Table2Excel('#view_productsSuppliedReport_page', {
        filename: "product_supplied_report"
    });

    productSuppliedReportExcel.export();
}


