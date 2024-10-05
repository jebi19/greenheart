const express = require('express');
const cors = require('cors');
const Razorpay = require('razorpay');
const app = express();

app.use(cors());
app.use(express.json()); // To parse JSON bodies

// Initialize Razorpay instance
const razorpay = new Razorpay({
    key_id: 'rzp_test_OGUUnI3XMQJ1zH',  // Replace with your Razorpay key_id
    key_secret: 'dlloC3M6ga9Gd7MbfCG1EEeY'        // Replace with your Razorpay key_secret
});

// Create Order endpoint
app.post('/create-order', async (req, res) => {
    try {
        const options = {
            amount: 30000, // Amount in the smallest currency unit (e.g., paise for INR)
            currency: "INR",        
            receipt: "receipt#1"
        };
        const order = await razorpay.orders.create(options);
        res.json({
            id: order.id,
            amount: order.amount,
            currency: order.currency
        });
    } catch (error) {
        res.status(500).json({ error: error.message });
    }
});

app.listen(3000, () => {
    console.log('Payment gateway running on http://localhost:3000');
});