import Web3 from "web3";
import contractData from "../../build/contracts/Spends.json" assert { type: "json" };

const contractABI = contractData.abi;
const contractAddress = "0x447Db080264BeD6Ed21D3a082aE4cdd7eBfe4E32";

const web3 = new Web3("http://127.0.0.1:8545");
const contract = new web3.eth.Contract(contractABI, contractAddress);

const pensionData = process.argv[2];

if (!pensionData) {
    console.error("Error: No pension data received.");
    process.exit(1);
}

async function storePensionData() {
    try {
        const data = JSON.parse(pensionData);
        console.log("Received Pension Data:", data);

        if (!data.total_beneficiaries || !data.total_pension_amount) {
            console.error("Invalid pension data. Check input format.");
            process.exit(1);
        }

        const accounts = await web3.eth.getAccounts();
        const receipt = await contract.methods
            .storePensionData(
                data.total_beneficiaries,
                data.total_pension_amount
            )
            .send({ from: accounts[0], gas: 6000000 });

        console.log("Transaction Successful:", receipt.transactionHash);
    } catch (error) {
        console.error("Error storing pension data on blockchain:", error);
        process.exit(1);
    }
}

storePensionData();
