const utils = {};

utils.numberFormatJs = function (amount, decimals = 2, decimalSeparator = ',', thousandSeparator = '.') {
    const formatter = new Intl.NumberFormat('id-ID', {
        minimumFractionDigits: decimals,
        maximumFractionDigits: decimals,
    });
    let formatted = formatter.format(amount);
    if (decimalSeparator !== ',') { formatted = formatted.replace(',', decimalSeparator); }
    if (thousandSeparator !== '.') { formatted = formatted.replace(/\./g, thousandSeparator); }
    return formatted;
}
module.exports = utils;