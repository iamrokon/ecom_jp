function zipFinder(zip)
{
    var regex = /^\d{7}$/;
    if(regex.test(zip))
    {
        return new Promise((resolve) => {
            var request = new XMLHttpRequest();
            var url = 'https://ita01.colgis.com/cgi-bin/http_yubin_get.cgi?PASSWORD=colgis.co.jp&YUBINBANGO=';
            url = url.concat(zip);
            request.open('GET',url,true);

            request.onload = function(){
                var data = this.response;
                var address = data.split("get_addr==")[1];
                if (address.includes("get_addr_furigana==")) address = '';
                resolve(address);
            };
            request.send();
        });
    }
    else alert('wrong zip format');
}