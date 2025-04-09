const Spends = artifacts.require("Spends");

module.exports = function (deployer) {
    deployer.deploy(Spends);
};
