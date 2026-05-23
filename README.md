# 🪙 Binance & Crypto Payment Gateway for DHRU Fusion

> Accept Bitcoin, USDT, USDC, ETH, and Binance payments directly into your wallet — no middleman, no merchant account, no KYC required. Automatically adds credit to customer accounts after payment is completed.

**Powered by [PayerURL](https://payerurl.com)** — the direct-to-wallet crypto payment processor for DHRU Fusion.

 🔑 **[Get API Key](https://dash.payerurl.com)** | 💬 **[Telegram Support](https://t.me/Payerurl)**

---

## ✅ Why Developers Choose This Package

| Feature | Detail |
|---|---|
| 🏦 **No merchant account needed** | Payments go directly to your crypto wallet |
| 🌍 **169+ fiat currencies** | USD, EUR, GBP, CAD and more — converted at live rates |
| ⚡ **Easy integration** | Simple setup, clear docs, 5-minute video guide |
| 🔒 **No KYC for basic accounts** | Start accepting payments without identity verification |
| 📱 **Binance QR Code payments** | Customers scan and pay without leaving your app |
| 💸 **Zero hidden fees** | No network surcharges or platform fees |
| 🤖 **Auto credit** | Automatically adds credit to customer accounts after payment |

---

## 🔸 Features

- 🔸 Binance Pay, USDT TRC20, BTC, ETH ERC20
- 🔸 Received customer payment direct to your crypto wallet
- 🔸 Easy signup, registration, and API key integration on [payerurl.com](https://payerurl.com)
- 🔸 24/7 customer support — contact us on Telegram: [t.me/Payerurl](https://t.me/Payerurl)

---

### Binance QR Code Payment

<img src="https://raw.githubusercontent.com/muhitmonsur/assets/refs/heads/main/screenshot-5.png">

This package is the ideal solution for developers seeking a secure Binance payment integration for Node.js and Express.js. Binance payment is a contactless, borderless, and highly secure payment method. By using this package, you can accept payments via Binance QR codes and process transactions through the Binance personal account API.

The package serves as a seamless bridge between Binance and your Node.js application. Customers simply scan the QR code on your checkout page to finish the transaction. This process is:

* **Fast and Simple**: No complex redirects or external logins for the user.
* **Cost-Effective**: Incurs no network fees or additional hidden costs.
* **Secure**: Enhanced security protocols help avoid scams and ensure transaction safety.

---

## 📦 Installation

### Step 1 — Download the Plugin

Download the custom DHRU Fusion USDT payment gateway as a `.zip` file from the link provided, then extract it.

### Step 2 — Upload Files to Your Server

- Log in to your hosting server **cPanel**
- Open **File Manager** and navigate to:
  - `public_html > modules > gateways`
  - Upload **`Payerurl.php`** from the extracted folder to this directory
  - Upload **`payerurl_res.php`** to the **`public_html`** root folder

### Step 3 — Configure in DHRU Fusion Admin

- Log in to your **DHRU Fusion admin panel**
- Go to **Settings → Payment Gateways**
- Search for **"USDT, ETH, BTC, Binance Pay"** and click **Activate**
- Click **Edit Gateway**

### Step 4 — Get Your API Keys

- Log in to the [Payerurl Dashboard](https://dash.payerurl.com)
- Go to **Get API Key Credentials → Generate New API Keys**
- If you don't have an account, click **"Create Account"** to register first

### Step 5 — Paste Your API Keys

- Copy your **Public Key** and **Secret Key** from the Payerurl dashboard
- Paste them into the DHRU Fusion **USDT, ETH, BTC, Binance Pay** edit module
- Click **Save**

You will see a **"Successfully Installed"** notification — you are now ready to accept crypto payments automatically! ✅

---

## 🔑 Get Your API Key (Free)

1. Sign up at **[dash.payerurl.com](https://dash.payerurl.com)**
2. Go to **Dashboard → Get API Credentials**
3. Copy your **Public Key** and **Secret Key**

> 👉 Registration is free and takes under 2 minutes. No credit card required.

---

## 🌐 Supported Cryptocurrencies & Networks

| Currency | Networks |
|---|---|
| **USDT** | TRC20 (Tron), ERC20 (Ethereum) |
| **USDC** | ERC20 (Ethereum) |
| **Bitcoin (BTC)** | Bitcoin Network |
| **Ethereum (ETH)** | ERC20 |
| **Binance Pay** | Binance QR Code |

---

## 📲 How the Binance QR Payment Works

1. Your DHRU Fusion store calls the API and gets a **payment URL**
2. Customer is redirected to a secure checkout page
3. Customer **scans the QR code** with their Binance app
4. Payment is confirmed and funds land **directly in your wallet**
5. Your `notify_url` receives a webhook with the order status update
6. Customer account is **automatically credited**

No bank accounts. No intermediaries. No waiting.

---

## 🎬 Complete Installation Video Guide

Watch the full step-by-step installation guide (5-minute video):

[![Watch the video](https://payerurl.com/wp-content/uploads/2023/10/dhru_youtube.png)](https://www.youtube.com/watch?v=TXgq3K7PgEo)

👉 [https://payerurl.com/dhru-fusion-usdt-payment-gateway-plugin/](https://payerurl.com/dhru-fusion-usdt-payment-gateway-plugin/)

---

![screenshot-1](https://raw.githubusercontent.com/muhitmonsur/assets/refs/heads/main/screenshot-1.png)
![screenshot-2](https://raw.githubusercontent.com/muhitmonsur/assets/refs/heads/main/screenshot-2.png)
![screenshot-4](https://raw.githubusercontent.com/muhitmonsur/assets/refs/heads/main/screenshot-4.png)
![screenshot-6](https://raw.githubusercontent.com/muhitmonsur/assets/refs/heads/main/screenshot-6.png)
![screenshot-7](https://raw.githubusercontent.com/muhitmonsur/assets/refs/heads/main/screenshot-7.png)
![screenshot-8](https://raw.githubusercontent.com/muhitmonsur/assets/refs/heads/main/screenshot-8.png)


## 📊 Full Payment Flow Diagram

```
Your DHRU Fusion Store → PayerURL API → Checkout Page → Customer Pays (Binance/Crypto)
                                                                  ↓
Your Wallet ← Funds (instant) ← Payment Verified ← Blockchain
                                                                  ↓
              notify_url ← Webhook → Customer Credit Added Automatically
```

---

## 🆚 Compared to Other Payment Solutions

| | **PayerURL (This Package)** | Stripe / PayPal | Coinbase Commerce |
|---|---|---|---|
| No merchant account | ✅ | ❌ | ✅ |
| Direct to your wallet | ✅ | ❌ | Partial |
| No KYC required | ✅ (Basic) | ❌ | ❌ |
| Binance QR support | ✅ | ❌ | ❌ |
| DHRU Fusion compatible | ✅ | ❌ | ❌ |
| Auto credit customer | ✅ | ❌ | ❌ |
| 169+ fiat currencies | ✅ | Partial | ❌ |
| Zero platform fees | ✅ | ❌ | ❌ |

---

## 🛡️ Security & Privacy

- ✅ Payments go directly to **your** wallet — PayerURL never holds your funds
- ✅ No mandatory KYC for basic accounts
- ✅ No personal identity verification required to get started
- ✅ Secure API with HMAC signature verification
- ✅ MIT licensed — fully open source, audit it yourself

---

## 🌍 Supported Fiat Currencies (169+)

USD, EUR, GBP, CAD, AUD, JPY, SGD, AED, INR, BRL, MXN, NGN, PKR, BDT, and 150+ more.

All fiat amounts are automatically converted to the equivalent crypto amount at live market rates.

---

## ❓ FAQ

**Do I need a Binance account?**
Yes, to accept Binance QR payments. For USDT/BTC/ETH/USDC, you just need the corresponding wallet address.

**Is there a transaction fee?**
No network or hidden fees from PayerURL. Standard blockchain network fees may apply depending on the coin.

**Can I use this without KYC?**
Yes. Basic accounts can receive and withdraw crypto without mandatory identity verification.

**Does it automatically credit the customer?**
Yes. After payment is confirmed via webhook, the system automatically adds credit to the customer's DHRU Fusion account.

**How long does setup take?**
Under 5 minutes. Watch the complete installation video guide linked above.

---

## 📬 Support

| Channel | Link |
|---|---|
| 💬 Telegram | [t.me/Payerurl](https://t.me/Payerurl) |
| 🌐 Website | [payerurl.com](https://payerurl.com) |
| 📊 Dashboard | [dash.payerurl.com](https://dash.payerurl.com) |
| 🎬 Video Guide | [payerurl.com/dhru-fusion-usdt-payment-gateway-plugin](https://www.youtube.com/watch?v=TXgq3K7PgEo) |

---

## 🤝 About Payerurl

[payerurl.com](https://payerurl.com) is an international provider of online cryptocurrency payment solutions. Payerurl is a crypto gateway that sends customer payments directly to merchant wallets and notifies merchants when a payment is made by a customer. It also automatically adds credit to the customer account after payment is completed.

---

## 📄 License

MIT License — free for personal and commercial use.

---

## 🏷️ Keywords

`crypto payment` `dhru fusion payment gateway` `binance payment gateway` `usdt payment dhru fusion` `bitcoin payment dhru fusion` `accept crypto dhru fusion` `crypto checkout` `binance qr code` `trc20 payment` `erc20 payment` `no kyc payment gateway` `direct wallet payment` `auto credit dhru fusion` `binance pay api` `payerurl dhru fusion`
