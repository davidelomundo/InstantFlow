paypal.Buttons({
    style: {
        color: 'blue',
        shape: 'pill'
    },
    createOrder: function(data, actions) {
        return actions.order.create({
            purchase_units: [{
                amount: {
                    value: '7.99'
                }
            }]
        })
    },
    onApprove: function(data, actions) {
        return actions.order.capture().then(function (details) {
            console.log(details);
        })
    }
}).render('#paypal-payment-button');