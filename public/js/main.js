/*   Main JS File  */

var data = {
    storage: window.sessionStorage,
    wn: $(window),
    body: $('body'),
    url: '',
    basketToken: window.sessionStorage.getItem('basketToken'),
    imgSlider: $('.slider'),
    user: {
        ShipToName: null,
        ShipToStreet1: null,
        ShipToCity: null,
        ShipToPostalCode: null,
        ShipToCountry: null,
    },
    markerCoordinates: {
        lat: 44.835591,
        lng: 20.410648
    },
    currCoordinates: {
        lat: null,
        lng: null
    },
    address: '',
    parents: '',
    newUrl: {
        cut: null,
        sub: null
    },
    guest: false,
    categories: window.Laravel || {},
    categoryId: null,
    category_name: (window.Laravel !== undefined) ? window.Laravel.category_name : '',
    subcategory: '',
    status: '',
    quantity: null,
    count: null,
    sumare: null,
    pdv: null,
    total: null,
    invoice: null,
    invItems: [],
    invoiceItem: [],
    invSum: 0,
    vaucer: false,
    invDate: new Date(),
    setBlog: null,
    selectedSubCat: [],
    products: [],
    selectedProducts: [],
    toDelete: '',
    isBlog: false,
    items: [],
    itemsNosub: false,
    itemID: [],
    colorShow: false,
    show: false,
    curr: '',
    showProduct: true,
    showCompany: false,
    checked: false,
    colorClass: '',
    color: {
        id: null, //this.items.item_in_basket_color[0].id
    },
};
var app = new Vue({
    el: '#app',
    data: data,
    filters: {
        isUndefined: function(value) {
            if (!value || 'undefined') {
                value = [];
                return value;
            }
            return value;
        },
        formatNumber(num) {
            num = parseFloat(num);
            return num.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
        },
        trimmedString(string) {
            var length = 20;
            return string.length > length ? string.substring(0, length - 3) + "..." : string;
        }
    },
    created: function() {
        this.initCategory();
        //    this.fetchMyBasket();
        console.log('items', this.items);
        //     this.scroll('body');
        if (this.categories.selectedSubCat !== undefined && this.categories.selectedSubCat !== null) {
            this.selectedSubCat = this.categories.selectedSubCat;
            this.showProduct = false;
            this.curr = this.category_name || this.categories.category[0].slug;
            $('.cat-list').find(`[data-cat-name='${this.curr}']`).find('input').attr('checked', true);
        }
    },
    methods: {
        ifGuest(guest) {
            guest = window.Laravel.user ? true : false;
            if (guest) {
                var authUser = (window.Laravel.user !== 'undefined') ? window.Laravel.user : null;
                this.user = {
                    ShipToName: (authUser.first_name + ' ' + authUser.last_name),
                    ShipToStreet1: authUser.address,
                    ShipToCity: authUser.city,
                    ShipToPostalCode: authUser.zip,
                    ShipToCountry: authUser.country,
                };

            }
        },
        uniqueID() {
            return this.chr4() + this.chr4() +
                '-' + this.chr4() +
                '-' + this.chr4() +
                '-' + this.chr4() +
                '-' + this.chr4() + this.chr4() + this.chr4();
        },
        chr4() {
            return Math.random().toString(16).slice(-4);
        },
        initCategory() {
            var vm = this,
                token = vm.storage.getItem('basketToken'),
                unique = vm.uniqueID();
            if (token === 'undefined' || token === null) {
                vm.basketToken = unique;
                console.log('token bio je undefined ili null', token)
            }
            axios.post('http://kreativnihobi.bgsvetionik.com/action-show', {
                'basketToken': vm.basketToken
            }).then(function(response) {
                vm.selectedProducts = response.data.action_products;
                vm.items = response.data.allInBaskets;
                vm.count = response.data.count;
                vm.isValidToPay(vm.count);
                vm.pdv = parseFloat(response.data.sumare) - (parseFloat(response.data.sumare) / (1 + (20 / 100)));
                vm.total = vm.sumare = parseFloat(response.data.sumare);

                var basketToken = response.data.basketToken,
                    newToken = vm.storage.getItem('newToken');
                if (newToken) {
                    vm.storage.setItem('basketToken', newToken);
                    vm.storage.removeItem('newToken');
                } else {
                    vm.storage.setItem('basketToken', basketToken);
                }
            });
        },
        getSubCategory(item, name, e) {
            var vm = this;
            vm.newUrl.cat = 'http://kreativnihobi.bgsvetionik.com/proizvodi/' + item + '/' + name;
            $(e.target).parent().siblings('li').find('input:checked').prop('checked', false);
            vm.selectedProducts = [];
            axios.post('http://kreativnihobi.bgsvetionik.com/category/subcategory', {
                'id': item
            }).then(function(response) {
                vm.showProduct = false;
                vm.selectedSubCat = response.data.subCat;
                vm.parents = response.data.parents;
                vm.itemsNosub = response.data.items;
                vm.selectedSubCat.category = name;
                history.pushState({}, null, vm.newUrl.cat);
            }).then(function() {
                $("html, body").animate({
                    scrollTop: 0
                }, "slow");

            });
        },
        getProduct(item, e) {
            var vm = this;
            $(e.target).parent().siblings('li').find('input:checked').prop('checked', false);

            axios.post('http://kreativnihobi.bgsvetionik.com/category/subcategory/products', {
                'id': item.id
            }).then(function(response) {
                vm.selectedSubCat.category = response.data.cat.slug || vm.curr;
                vm.showProduct = true;
                vm.selectedProducts = response.data.all_products;
                vm.selectedProducts.subCat = item.slug;
                vm.selectedProducts.iD = item.id;
                vm.newUrl.sub = window.location.href + '/' + item.id + '/' + vm.selectedProducts.subCat;
                history.pushState({}, null, vm.newUrl.sub);
            }).then(function() {
                $("html, body").animate({
                    scrollTop: 0
                }, "slow");

            });
        },
        setColor(item, e) {
            this.color = item;
            this.colorClass = 'cc_' + item.code;
        },
        addToBasket(id, name, colorId) {
            var vm = this,
                amount = 1;
            colorId = colorId || null;
            //console.log('basketToken', basketToken)
            axios.post('http://kreativnihobi.bgsvetionik.com/item', {
                'id': id,
                'basketToken': vm.basketToken,
                'amount': amount,
                color: colorId
            }).then(function(response) {
                var data = response.data;
                var userBasket = data.userBasket;
                var classCss = data.classCss;
                vm.basketToken = data.basketToken;
                vm.items = data.allInBaskets;
                vm.count = data.count;
                vm.isValidToPay(vm.count);
                if (classCss === 'success') {
                    Materialize.toast('Proizvod pod nazivom ' + name + ' je dodat u korpu!', 4000, classCss)
                } else {
                    Materialize.toast('Greska prilikom unosa proizvoda <br>' + name + '<br>u vasu korpu, refresujte stranicu!', 4000, classCss)
                }
                vm.storage.setItem('basketToken', vm.basketToken);
            });
        },
        increase(item) {

            var vm = this;
            axios.post('http://kreativnihobi.bgsvetionik.com/increase', {
                'basketToken': vm.basketToken,
                'id': item.id
            }).then(function(response) {
                vm.items = response.data.allInBaskets;
                vm.total = vm.sumare = parseFloat(response.data.sumare);
                vm.pdv = parseFloat(response.data.sumare) - (parseFloat(response.data.sumare) / (1 + (20 / 100)));
                vm.count = response.data.count;
                vm.isValidToPay(vm.count);
            });
        },
        decrease(item) {
            if (item.amount > 1) {
                var vm = this;
                axios.post('http://kreativnihobi.bgsvetionik.com/decrease', {
                    'basketToken': vm.basketToken,
                    'id': item.id
                }).then(function(response) {
                    vm.items = response.data.allInBaskets;
                    vm.total = vm.sumare = parseFloat(response.data.sumare);
                    vm.pdv = parseFloat(response.data.sumare) - (parseFloat(response.data.sumare) / (1 + (20 / 100)));
                    vm.count = response.data.count;
                    vm.isValidToPay(vm.count);
                });
            } else {
                return false;
            }
        },
        deleteItem(id) {
            var vm = this;

            axios.post('http://kreativnihobi.bgsvetionik.com/item/delete', {
                'id': id,
                'basketToken': vm.basketToken
            }).then(function(response) {
                var classCss = response.data.classCss;
                vm.items = response.data.allInBaskets;
                vm.total = vm.sumare = parseFloat(response.data.sumare);
                vm.pdv = parseFloat(response.data.sumare) - (parseFloat(response.data.sumare) / (1 + (20 / 100)));
                vm.count = response.data.count;
                vm.isValidToPay(vm.count);
                if (classCss === 'success') {
                    Materialize.toast('Proizvod je izbrisan iz korpe!', 4000, classCss)
                } else {
                    Materialize.toast('Greska prilikom brisanja proizvoda <br> iz vase korpe, refresujte stranicu!', 4000, classCss)
                }

            });
        },
        isValidToPay(count) {
            if ($('#paynow').length) {
                if (count > 0) {
                    $('#paynow').removeClass('disabled');
                } else {
                    $('#paynow').addClass('disabled');
                }
            }
        },
        showInvoice(item, basket) {
            this.invoiceItem = basket;
            this.invoice = item.Invoice;
            this.invItems = [];
            this.invDate = item.created_at;
            var sum = 0;
            for (var i = 0; i < this.invoiceItem.length; i++) {
                if (this.invoiceItem[i].Invoice === this.invoice) {
                    sum += (this.invoiceItem[i].price * this.invoiceItem[i].amount);
                    this.invItems.push(this.invoiceItem[i]);
                }
            }
            this.invSum = sum;
        },
        refreshToken() {
            var unique = this.uniqueID();
            this.storage.setItem('newToken', unique);
        },
        payNow() {
            this.basketToken = this.storage.getItem('basketToken');
            window.location.href = 'http://kreativnihobi.bgsvetionik.com/placanje/' + this.basketToken;
        },
        sendForm() {
            //    this.url = 'https://entegrasyon.asseco-see.com.tr/fim/est3Dgate';
            $('#payments').submit();
        },
        sendMail() {
            var vm = this;
            vm.basketToken = vm.storage.getItem('basketToken');
            var form = $('#payments').serializeArray();
            var dataForm = {};
            $.each(form, function(index, val) {
                dataForm[val.name] = val.value
            });
            console.log(dataForm)
            axios.post('http://kreativnihobi.bgsvetionik.com/send-order', dataForm).then(function(response) {
                var msg = response.data.msg;
                var classCss = response.data.classCss;
                Materialize.toast(msg, 4000, classCss)
            //  window.location.href = 'http://kreativnihobi.bgsvetionik.com/placanje/' + this.basketToken;
            });
        },
        getBlog(id) {
            var vm = this;
            axios.post('http://kreativnihobi.bgsvetionik.com/blog', {
                'id': id,
            }).then(function(response) {
                vm.isBlog = true;
                vm.setBlog = response.data.get_blog;
            });
        },
        closeAlert() {
            $("#alert_box").fadeOut("slow", function() {});
        },
        closeDiv(elem) {
            $('#' + elem).removeClass('scale-in');
            $('#' + elem).addClass('scale-out');
        },
        _formatNumber(num, places) {
            return num.toFixed(places)
                .replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
        },
        _toJSONString(obj) {
            var str = JSON.stringify(obj);
            return str;
        },
        _toJSONObject(str) {
            var obj = JSON.parse(str);
            return obj;
        },
        backUrl() {
            window.location.href = document.referrer;
        },

        toggleSearch() {
            $('#scale-search').toggleClass('scale-out');
            this.show = !this.show;
        },
        toggleColor() {
            this.colorShow = !this.colorShow;
        },
        scroll(elem) {
            var elem = $(elem);
            // alert('aha')
            elem.niceScroll({
                scrollspeed: 60,
                mousescrollstep: 80,
                bouncescroll: true,
                cursorcolor: "rgb(194, 194, 194)",
                cursorborder: "1px solid rgb(217, 217, 217)",
            });
        },
        scrollTop() {
            var body = $("html, body");

            body.animate({
                scrollTop: 0
            }, "slow");
        },
        createMap() {
            var vm = this;
            var map = new google.maps.Map(document.getElementById('map'), {
                center: vm.markerCoordinates,
                zoom: 12
            });
            var marker = new google.maps.Marker({
                position: vm.markerCoordinates,
                map: map,
                title: 'Kreativni Hobi'
            });
        },
        userMap() {
            var vm = this;
            setTimeout(() => {
                var map = new google.maps.Map(document.getElementById('map'), {
                    center: {
                        lat: parseFloat(window.Laravel.user.lat) || 44.8355,
                        lng: parseFloat(window.Laravel.user.lng) || 20.4106
                    },
                    zoom: 12
                });
                var marker = new google.maps.Marker({
                    position: {
                        lat: parseFloat(window.Laravel.user.lat) || 44.8355,
                        lng: parseFloat(window.Laravel.user.lng) || 20.4106
                    },
                    map: map,
                    title: " Vaša lokacija \n " + window.Laravel.user.first_name + ' ' + window.Laravel.user.last_name
                });
            }, 0);
        },
        getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(this.showPosition);
            } else {
                Materialize.toast('Geolocation is not supported by this browser.', 4000);
            }
        },
        showPosition(position) {
            this.currCoordinates = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
        },
        isScrolling() {
            var top = $('#to-top');
            if (this.wn.scrollTop() > 300) {
                this.body.addClass('isScrolling');

            } else {
                this.body.removeClass('isScrolling');

            }
        }
    },

    mounted() {
        // Materialize.updateTextFields();+
        this.isScrolling();
        this.wn.on('scroll', this.isScrolling);
        $('.button-collapse')
            .sideNav({
                menuWidth: 300,
                edge: 'left',
                closeOnClick: true,
                draggable: true,
            });
        $('.collapsible').collapsible('open', 0);
        $('.slider').slider();
        $('.dropdown-button').dropdown({
            inDuration: 300,
            outDuration: 225,
            hover: true, // Activate on hover
            belowOrigin: true, // Displays dropdown below the button
            alignment: 'left' // Displays dropdown with edge aligned to the left of button
        });
        $('.notification-button').dropdown({
            inDuration: 300,
            outDuration: 225,
            constrainWidth: false,
            hover: true,
            gutter: 0,
            belowOrigin: true,
            alignment: 'right',
            stopPropagation: false
        });
        /*      $( '.fixed-action-btn.toolbar' )
                          .openToolbar( );
                  $( '.fixed-action-btn.toolbar' )
                          .closeToolbar( );*/
        $('.center-slick').slider({

            infinite: true,
            slidesToShow: 3,
            autoplay: true,
            autoplaySpeed: 3000,
            speed: 800,
            responsive: [{
                breakpoint: 1044,
                settings: {
                    arrows: true,
                    slidesToShow: 2
                }
            }, {
                breakpoint: 900,
                settings: {
                    arrows: true,
                    slidesToShow: 3
                }
            }, {
                breakpoint: 600,
                settings: {
                    arrows: true,
                    slidesToShow: 2
                }
            }, {
                breakpoint: 480,
                settings: {
                    arrows: true,
                    slidesToShow: 1
                }
            }]
        });

    }
});