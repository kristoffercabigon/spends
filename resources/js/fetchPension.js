import Web3 from "web3";
import contractData from "../../build/contracts/Spends.json" assert { type: "json" };

const contractABI = contractData.abi;
const contractAddress = "0x2e124F38F8021986c4Ba1459C42AeA2B7DE644cb";

const web3 = new Web3("http://127.0.0.1:8545");
const contract = new web3.eth.Contract(contractABI, contractAddress);

async function getPensionData() {
    try {
        const pensionData = await contract.methods.getPensionData().call();
        const latestBlock = await web3.eth.getBlock("latest");

        if (!pensionData) {
            console.log(
                JSON.stringify({
                    success: false,
                    message: "No pension data found on blockchain.",
                })
            );
            return;
        }

        const totalBeneficiaries = BigInt(pensionData[0]).toString();
        const totalPensionAmount = BigInt(pensionData[1]).toString();
        const seniorIds = JSON.parse(pensionData[2]);
        const timestamp = new Date(
            Number(pensionData[3]) * 1000
        ).toLocaleString();
        const currentBlockHash = latestBlock.hash;
        const previousBlockHash = latestBlock.parentHash;

        console.log(
            JSON.stringify({
                success: true,
                total_beneficiaries: totalBeneficiaries,
                total_pension_amount: totalPensionAmount,
                senior_ids: seniorIds,
                timestamp: timestamp,
                current_block_hash: currentBlockHash,
                previous_block_hash: previousBlockHash,
            })
        );
    } catch (error) {
        console.error("Error fetching pension data:", error);
        console.log(
            JSON.stringify({
                success: false,
                message: "Error fetching pension data",
            })
        );
    }
}

getPensionData();
