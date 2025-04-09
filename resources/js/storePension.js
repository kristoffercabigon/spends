import fs from "fs";
import Web3 from "web3";
import contractData from "../../build/contracts/Spends.json" assert { type: "json" };

const contractABI = contractData.abi;
const contractAddress = "0x2e124F38F8021986c4Ba1459C42AeA2B7DE644cb";

const web3 = new Web3("http://127.0.0.1:8545");
const contract = new web3.eth.Contract(contractABI, contractAddress);

const filePath = process.argv[2];

if (!filePath) {
    console.error("Error: No file path provided.");
    process.exit(1);
}

let data;
try {
    const fileContents = fs.readFileSync(filePath, "utf8");
    data = JSON.parse(fileContents);
    console.log("Parsed Pension Data:", data);
} catch (error) {
    console.error("JSON Parsing Error:", error.message);
    process.exit(1);
}

if (
    !data.total_beneficiaries ||
    !data.total_pension_amount ||
    !Array.isArray(data.senior_ids)
) {
    console.error("Invalid pension data. Check input format.");
    process.exit(1);
}

async function storePensionData() {
    try {
        const accounts = await web3.eth.getAccounts();
        console.log("Using account:", accounts[0]);

        const receipt = await contract.methods
            .storePensionData(
                data.total_beneficiaries,
                data.total_pension_amount,
                JSON.stringify(data.senior_ids)
            )
            .send({ from: accounts[0], gas: 6000000 });

        console.log("Transaction Successful:", receipt.transactionHash);
        fs.unlinkSync(filePath);
    } catch (error) {
        console.error("Error storing pension data on blockchain:", error);
        process.exit(1);
    }
}

storePensionData();
