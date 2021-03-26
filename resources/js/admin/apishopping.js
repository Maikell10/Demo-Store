const apishopping = new Vue({
    el: "#apishopping",
    data: {

        serie: '',
        number: '',
        date: '',

        products: [],
        cantidad: [],
        precio_compra: [],
        precio_venta: [],

        text: $('#text_action').val(),
        textDelete: $('#text_actionD').val(),

        total_compra: 0,
        total_compraSF: 0,
        subtotalE: 0,
        ganancia: 0,

        cont: 0,
        indexProd: '',

        tax: 0,
        taxs: 0,

        productsSend: '',
        
    },
    methods: {
        agregarDetalle(id_product) {
            axios
                .get("/api/shopping/add", {
                    params: { id_product: id_product }
                })
                .then(response => {
                    if(this.products.length > 0) {
                        this.cont = 0;
                        for (let i = 0; i < this.products.length; i++) {
                            if(this.products[i]['id'] == response.data['id']) {
                                this.cont = 1
                                this.indexProd = i
                            }
                        }
                        if (this.cont != 1) {
                            this.products.push(response.data)
                        } else {
                            this.products[this.indexProd]['cant'] = parseInt(this.products[this.indexProd]['cant']) +1
                            this.cantidad[this.indexProd] = this.cantidad[this.indexProd] + 1

                            this.products[this.indexProd]['precio_venta'] = ((this.precio_compra[this.indexProd] * this.ganancia)/100);
                            this.products[this.indexProd]['precio_venta'] = parseFloat(this.products[this.indexProd]['precio_venta']) + parseFloat(this.precio_compra[this.indexProd])
                            
                            this.products[this.indexProd]['subtotal'] = this.precio_compra[this.indexProd] * this.cantidad[this.indexProd];
                            this.products[this.indexProd]['subtotalSF'] = this.precio_compra[this.indexProd] * this.cantidad[this.indexProd];

                            this.total_compra = 0
                            for (let i = 0; i < this.products.length; i++) {
                                this.total_compra = this.total_compra + this.products[i]['subtotalSF']
                            }

                            this.taxs = (this.tax * (this.total_compra + this.subtotalE))/100
                            this.total_compraSF = (this.total_compra + this.subtotalE) + this.taxs
                            this.total_compra = this.format((this.total_compra + this.subtotalE) + this.taxs)
                            this.taxs = this.format(this.taxs)

                            this.products[this.indexProd]['precio_ventaSF'] = this.products[this.indexProd]['precio_venta']
                            this.products[this.indexProd]['precio_venta'] = this.format(this.products[this.indexProd]['precio_venta'])
                            this.products[this.indexProd]['subtotal'] = this.format(this.products[this.indexProd]['subtotal'])
                        }
                    } else {
                        this.products.push(response.data)
                    }
                    
                    this.cantidad.push(1)
                    this.precio_compra.push(0)
                    this.precio_venta.push(0)

                    this.productsSend = JSON.stringify(this.products)
                });
            
        },
        sumCant(index) {
            this.cantidad[index] = parseInt(this.cantidad[index]) + 1
            this.products[index]['cant'] = this.cantidad[index]

            this.products[index]['precio_venta'] = ((this.precio_compra[index] * this.ganancia)/100);
            this.products[index]['precio_venta'] = parseFloat(this.products[index]['precio_venta']) + parseFloat(this.precio_compra[index])
            
            this.products[index]['subtotal'] = this.precio_compra[index] * this.cantidad[index];
            this.products[index]['subtotalSF'] = this.precio_compra[index] * this.cantidad[index];

            this.total_compra = 0
            for (let i = 0; i < this.products.length; i++) {
                this.total_compra = this.total_compra + this.products[i]['subtotalSF']
            }
            this.taxs = (this.tax * (this.total_compra + this.subtotalE))/100
            this.total_compraSF = (this.total_compra + this.subtotalE) + this.taxs
            this.total_compra = this.format((this.total_compra + this.subtotalE) + this.taxs)
            this.taxs = this.format(this.taxs)

            this.products[index]['precio_ventaSF'] = this.products[index]['precio_venta']
            this.products[index]['precio_venta'] = this.format(this.products[index]['precio_venta'])
            this.products[index]['subtotal'] = this.format(this.products[index]['subtotal'])

            this.productsSend = JSON.stringify(this.products)
        },
        deleteCant(index) {
            if (this.cantidad[index] > 0) {
                this.cantidad[index] = parseInt(this.cantidad[index]) - 1
                this.products[index]['cant'] = this.cantidad[index]

                this.products[index]['precio_venta'] = ((this.precio_compra[index] * this.ganancia)/100);
                this.products[index]['precio_venta'] = parseFloat(this.products[index]['precio_venta']) + parseFloat(this.precio_compra[index])
            
                this.products[index]['subtotal'] = this.precio_compra[index] * this.cantidad[index];
                this.products[index]['subtotalSF'] = this.precio_compra[index] * this.cantidad[index];

                this.total_compra = 0
                for (let i = 0; i < this.products.length; i++) {
                    this.total_compra = this.total_compra + this.products[i]['subtotalSF']
                }
                this.taxs = (this.tax * (this.total_compra + this.subtotalE))/100
                this.total_compraSF = (this.total_compra + this.subtotalE) + this.taxs
                this.total_compra = this.format((this.total_compra + this.subtotalE) + this.taxs)
                this.taxs = this.format(this.taxs)

                this.products[index]['precio_ventaSF'] = this.products[index]['precio_venta']
                this.products[index]['precio_venta'] = this.format(this.products[index]['precio_venta'])
                this.products[index]['subtotal'] = this.format(this.products[index]['subtotal'])

                this.productsSend = JSON.stringify(this.products)
            } else {
                Swal.fire({
                    text: this.text,
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    toast: true,
                    position: 'top-end',
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })
            }
        },
        sumPrecioC(index) {
            this.products[index]['cant'] = parseInt(this.products[index]['cant'])
            this.cantidad[index] = this.products[index]['cant']

            this.products[index]['precio_venta'] = ((this.precio_compra[index] * this.ganancia)/100);
            this.products[index]['precio_venta'] = parseFloat(this.products[index]['precio_venta']) + parseFloat(this.precio_compra[index])

            this.products[index]['subtotal'] = this.precio_compra[index] * this.cantidad[index];
            this.products[index]['subtotalSF'] = this.precio_compra[index] * this.cantidad[index];

            this.products[index]['precio_ventaSF'] = this.products[index]['precio_venta']
            this.products[index]['precio_venta'] = this.format(this.products[index]['precio_venta'])
            this.products[index]['subtotal'] = this.format(this.products[index]['subtotal'])

            this.total_compra = 0
            for (let i = 0; i < this.products.length; i++) {
                this.total_compra = this.total_compra + this.products[i]['subtotalSF']
            }
            this.taxs = (this.tax * (this.total_compra + this.subtotalE))/100
            this.total_compraSF = (this.total_compra + this.subtotalE) + this.taxs
            this.total_compra = this.format((this.total_compra + this.subtotalE) + this.taxs)
            this.taxs = this.format(this.taxs)

            this.products[index]['precio_compra'] = parseFloat(this.precio_compra[index])
            this.productsSend = JSON.stringify(this.products)
        },

        giveGanancia(){
            for (let i = 0; i < this.products.length; i++) {
                this.products[i]['precio_venta'] = ((this.precio_compra[i] * this.ganancia)/100)
                this.products[i]['precio_venta'] = parseFloat(this.products[i]['precio_venta']) + parseFloat(this.precio_compra[i])

                this.products[i]['precio_ventaSF'] = this.products[i]['precio_venta']
                this.products[i]['precio_venta'] = this.format(this.products[i]['precio_venta'])
            }

            this.productsSend = JSON.stringify(this.products)
        },
        giveTax(){
            this.total_compra = 0
            for (let i = 0; i < this.products.length; i++) {
                this.total_compra = this.total_compra + this.products[i]['subtotalSF']
            }
            this.taxs = (this.tax * (this.total_compra + this.subtotalE))/100
            this.total_compraSF = (this.total_compra + this.subtotalE) + this.taxs
            this.total_compra = this.format((this.total_compra + this.subtotalE) + this.taxs)
            this.taxs = this.format(this.taxs)
        },

        deleteProd(index){
            this.products.splice(index, 1);
            this.cantidad.splice(index, 1);
            this.precio_compra.splice(index, 1);
            this.precio_venta.splice(index, 1);

            this.total_compra = 0
            for (let i = 0; i < this.products.length; i++) {
                this.total_compra = this.total_compra + this.products[i]['subtotalSF']
            }

            this.taxs = (this.tax * (this.total_compra + this.subtotalE))/100
            this.total_compraSF = (this.total_compra + this.subtotalE) + this.taxs
            this.total_compra = this.format((this.total_compra + this.subtotalE) + this.taxs)
            this.taxs = this.format(this.taxs)

            if(this.total_compra == '-') {
                this.total_compra = 0
            }

            Swal.fire({
                text: this.textDelete,
                icon: 'error',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                toast: true,
                position: 'top-end',
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            this.productsSend = JSON.stringify(this.products)
        },

        format(num) {
            if (!num || num == 'NaN') return '-';
            if (num == 'Infinity') return '&#x221e;';
            num = num.toString().replace(/\$|\,/g, '');
            if (isNaN(num))
                num = "0";
            var sign = (num == (num = Math.abs(num)));
            num = Math.floor(num * 100 + 0.50000000001);
            var cents = num % 100;
            num = Math.floor(num / 100).toString();
            if (cents < 10)
                cents = "0" + cents;
            for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3) ; i++)
                num = num.substring(0, num.length - (4 * i + 3)) + ',' + num.substring(num.length - (4 * i + 3));
            return (((sign) ? '' : '-') + num + '.' + cents);
        },
    },
    mounted() {
        this.text = $('#text_action').val()
        this.textDelete = $('#text_actionD').val()

        if ($('#editar').val() == 'Si') {
            this.ganancia = parseFloat($('#ganancia1').val())
            this.number = $('#number1').val()
            this.serie = $('#serie1').val()
            this.tax = parseFloat($('#tax1').val())
            this.date = $('#date1').val()

            this.total_compra = parseFloat($('#total1').val())
            this.subtotalE = parseFloat($('#total1').val())
            this.taxs = (this.tax * this.total_compra)/100
            this.total_compraSF = this.total_compra + this.taxs
            this.total_compra = this.format(this.total_compra + this.taxs)
            this.taxs = this.format(this.taxs)
        }
    }
});
