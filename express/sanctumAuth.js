const axios = require('axios');

const authenticate = async (req, res, next) => {
  try {
    
    const token = req.headers.authorization.replace('Bearer ', '');

    // Send a request to your Laravel application to validate the token
    const response = await axios.get('http://your-laravel-app.com/sanctum/csrf-cookie', {
      headers: {
        'Authorization': `Bearer ${token}`,
        'Accept': 'application/json'
      },
      withCredentials: true
    });

    if (response.status === 204) {
      // Token is valid, proceed to the next middleware
      next();
    } else {
      res.status(401).json({ error: 'Invalid token.' });
    }
  } catch (error) {
    console.error(error);
    res.status(500).json({ error: 'Failed to authenticate token.' });
  }
};

module.exports = authenticate;
