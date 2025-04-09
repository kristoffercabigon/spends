import Web3 from "web3";
import Spends from "../../build/contracts/Spends.json" assert { type: "json" };

const web3 = new Web3("http://127.0.0.1:8545");
const contractAddress = "0x2e124F38F8021986c4Ba1459C42AeA2B7DE644cb";
const contract = new web3.eth.Contract(Spends.abi, contractAddress);

export { web3, contract };
