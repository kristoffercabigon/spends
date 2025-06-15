# 🧓 OSCA Spends - Blockchain-Based Senior Citizen Registry

The **OSCA Spends** system is a blockchain-integrated web application developed for the **Office of Senior Citizens Affairs (OSCA)** in **North Caloocan City**. It is designed to manage the registration and verification of senior citizens and ensure **data integrity** using **blockchain technology**.

Built using **Laravel**, **PHP**, **Tailwind CSS**, **MySQL**, and **Solidity**, the system streamlines the administration of senior citizen records while providing a secure and transparent way to verify beneficiaries.

---

## 🔐 Key Features

- ✅ **Senior Registration and Verification**  
  Encoders can add and update senior citizen and guardian records. Also, they can add update and delete the events and announcements detail.

- 🧾 **Blockchain Integration (Ganache/Polygon Testnet)**  
  Once verified, senior records are hashed and stored on the blockchain to ensure immutability and prevent tampering.

- 📊 **Barangay Statistics Dashboard**  
  Monthly statistics on verified senior citizens are recorded and visualized per barangay.

- 🧮 **Pension Monitoring Support (Non-Financial)**  
  Tracks total verified seniors per barangay to monitor eligibility and detect unusual spikes (fraud detection metric).

- 🔐 **Merkle Root / Hash Validation**  
  Instead of storing full datasets, hashes of verified senior data are stored on-chain to minimize gas fees.

- 🛡️ **Role-Based Access Control**
  - **Admin** – Full access, blockchain management, encoder management
  - **Encoder** – Can add/edit senior and guardian records. Can add/edit/delete events and announcements.
  - **Senior Citizen** – View-only access to events, announcements and account page

---

## 🛠️ Technologies Used

- **Laravel 10 (PHP)**
- **Tailwind CSS**
- **JavaScript**
- **MySQL**
- **Solidity (Smart Contracts)**
-  **Web3.js**
- **Ganache / Truffle**

