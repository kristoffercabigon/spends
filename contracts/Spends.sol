// SPDX-License-Identifier: MIT
pragma solidity ^0.8.20;

contract Spends {
    struct PensionData {
        uint256 totalBeneficiaries;
        uint256 totalPensionAmount;
        string seniorIds;
        uint256 timestamp;
    }

    PensionData public pensionData;

    event PensionStored(uint256 totalBeneficiaries, uint256 totalPensionAmount, string seniorIds, uint256 timestamp);

    function storePensionData(uint256 _totalBeneficiaries, uint256 _totalPensionAmount, string memory _seniorIds) public {
        pensionData = PensionData(_totalBeneficiaries, _totalPensionAmount, _seniorIds, block.timestamp);
        emit PensionStored(_totalBeneficiaries, _totalPensionAmount, _seniorIds, block.timestamp);
    }

    function getPensionData() public view returns (uint256 totalBeneficiaries, uint256 totalPensionAmount, string memory seniorIds, uint256 timestamp) {
        return (pensionData.totalBeneficiaries, pensionData.totalPensionAmount, pensionData.seniorIds, pensionData.timestamp);
    }
}
