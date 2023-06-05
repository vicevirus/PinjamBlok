pragma solidity >=0.4.22 <0.9.0;

contract TransactionRegistry {
    struct Transaction {
        string action;
        uint256 duration;
        uint256 borrower_id;
        uint256 item_id;
        uint256 room_id;
        uint256 created_at;
        string transact_hash;
    }

    mapping(string => Transaction) public transactions;
    
    function storeTransaction(
        string memory _action,
        uint256 _duration,
        uint256 _borrower_id,
        uint256 _item_id,
        uint256 _room_id,
        uint256 _created_at,
        string memory _transact_hash
    ) public {
        require(transactions[_transact_hash].created_at == 0, "Transaction already exists");
        
        Transaction memory newTransaction = Transaction(
            _action,
            _duration,
            _borrower_id,
            _item_id,
            _room_id,
            _created_at,
            _transact_hash
        );

        transactions[_transact_hash] = newTransaction;
    }

    function getTransactionByHash(string memory _transact_hash) public view returns (
        string memory,
        uint256,
        uint256,
        uint256,
        uint256,
        uint256,
        string memory
    ) {
        Transaction storage transaction = transactions[_transact_hash];
        require(bytes(transaction.transact_hash).length != 0, "Transaction not found");

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
