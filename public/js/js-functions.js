function rowClick(routeName, selectedPk){
    var url = `/${routeName}/${selectedPk}`;

    window.location.href = url;
}

function formatIndianCurrency($number) {
    return number_format($number, 2, '.', ',');
}
