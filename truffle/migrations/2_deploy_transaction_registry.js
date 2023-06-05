const TransactionRegistry = artifacts.require("TransactionRegistry");

module.exports = function (deployer) {
  deployer.deploy(TransactionRegistry);
};
