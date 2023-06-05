// SPDX-License-Identifier: MIT
pragma solidity >=0.4.22 <0.9.0;

contract TransactionRegistry {
    struct Transaction {
        string action;
        uint256 duration;
        uint256 borrower_id;
        uint256 item_id;
        uint256 room_id;
        uint256 created_at;
        bytes32 transact_hash;
    }

    Transaction[] public transactions;
    mapping(bytes32 => uint256) public transactionIndices;

    function storeTransaction(
        string memory _action,
        uint256 _duration,
        uint256 _borrower_id,
        uint256 _item_id,
        uint256 _room_id,
        uint256 _created_at,
        bytes32 _transact_hash
    ) public {
        Transaction memory newTransaction = Transaction(
            _action,
            _duration,
            _borrower_id,
            _item_id,
            _room_id,
            _created_at,
            _transact_hash
        );

        transactions.push(newTransaction);
        transactionIndices[_transact_hash] = transactions.length - 1;
    }

    function getTransactionByHash(bytes32 _transact_hash) public view returns (
        string memory,
        uint256,
        uint256,
        uint256,
        uint256,
        uint256,
        bytes32
    ) {
        uint256 index = transactionIndices[_transact_hash];
        require(index < transactions.length, "Transaction not found");

        Transaction storage transaction = transactions[index];
        return (
            transaction.action,
            transaction.duration,
            transaction.borrower_id,
            transaction.item_id,
            transaction.room_id,
            transaction.created_at,
            transaction.transact_hash
        );
    }
}
