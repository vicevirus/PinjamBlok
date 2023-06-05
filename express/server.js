const express = require('express');
const app = express();
const Web3 = require('web3');
const contract = require('truffle-contract');
const axios = require('axios');
const TransactionRegistryContract = require('../truffle/build/contracts/TransactionRegistry.json');

// Set up Web3 provider
const providerUrl = 'http://127.0.0.1:8545'; // URL of your Ganache instance
const web3 = new Web3(new Web3.providers.HttpProvider(providerUrl));

// Get the deployed contract instance
const TransactionRegistry = contract(TransactionRegistryContract);
TransactionRegistry.setProvider(web3.currentProvider);

// Middleware to parse JSON requests
app.use(express.json());

app.get('/transactions/:hash', async (req, res) => {
  const { hash } = req.params;

  try {
    const instance = await TransactionRegistry.deployed();
    const transaction = await instance.getTransactionByHash('0x' + hash); // Add the '0x' prefix

    const modifiedTransaction = {
      action: transaction['0'],
      duration: transaction['1'],
      borrower_id: transaction['2'],
      item_id: transaction['3'],
      room_id: transaction['4'],
      created_at: transaction['5'],
      transact_hash: transaction['6']
    };

    res.json({ transaction: modifiedTransaction });
  } catch (error) {
    console.error(error);
    res.status(500).json({ error: 'Failed to fetch transaction.' });
  }
});

app.post('/api/auth', async (req, res) => {
  const { action, duration, borrower_id, item_id, room_id, created_at, transact_hash } = req.body;

  // Extract the token from the request headers
  const token = req.headers.authorization;

  try {
    // Authenticate with your Laravel server
    const response = await axios.post('http://dappborrow.test/api/auth', null, {
      headers: {
        Authorization: "Bearer " + token,
      },
    });

    // If authentication is successful, proceed with storing the transaction
    if (response.status === 200) {
      const accounts = await web3.eth.getAccounts();
      const instance = await TransactionRegistry.deployed();

      const formattedHash = '0x' + transact_hash; // Add 0x prefix to transact_hash
      
      await instance.storeTransaction(action, duration, borrower_id, item_id, room_id, created_at, formattedHash, { from: accounts[0] });

      res.json({ message: 'Transaction stored successfully.' });
    } else {
      res.status(401).json({ error: 'Unauthorized. Failed to authenticate.' });
    }
  } catch (error) {
    if (error.response && error.response.status === 401) {
      res.status(401).json({ error: 'Unauthorized. Failed to authenticate.' });
    } else {
      console.error(error);
      res.status(500).json({ error: 'Failed to store transaction.' });
    }
  }
});


// Start the server
app.listen(3000, () => {
  console.log('Server running on port 3000');
});
