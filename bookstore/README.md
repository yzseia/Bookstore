# The Book Nook - Complete Bookstore Project

A fully functional online bookstore built with PHP, MySQL, Bootstrap, and jQuery.

## Features

### User Authentication
- User registration and login system
- Session management
- Secure password hashing
- JSON-based user storage

### Product Management
- Dynamic product display
- Product search and filtering
- Category-based organization
- Price range filtering
- Responsive product cards

### Shopping Cart
- Add/remove items from cart
- Quantity management (increase/decrease)
- Real-time cart updates
- Cart persistence across sessions
- Cart badge notifications

### User Interface
- Responsive Bootstrap design
- Interactive hover effects
- Toast notifications
- Modal dialogs
- Smooth animations

## File Structure

```
bookstore/
├── auth/
│   ├── login.php          # User login page
│   ├── signup.php         # User registration page
│   ├── logout.php         # Session logout
│   └── users.json         # User data storage
├── css/
│   └── styles.css         # Custom CSS styles
├── js/
│   └── script.js          # JavaScript functionality
├── includes/
│   ├── header.php         # Common header template
│   ├── footer.php         # Common footer template
│   └── product-data.php   # Product data array
├── images/                # Product images directory
├── index.php              # Homepage
├── products.php           # All products page
├── cart.php               # Shopping cart page
├── add-to-cart.php        # Add to cart handler
├── remove-from-cart.php   # Cart modification handler
└── README.md              # Project documentation
```

## Installation

1. **Setup Web Server**
   - Install XAMPP, WAMP, or LAMP
   - Place project files in htdocs/www directory

2. **File Permissions**
   - Ensure `auth/users.json` is writable
   - Set proper permissions for image uploads

3. **Access the Application**
   - Navigate to `http://localhost/bookstore/`
   - Create a new account or login

## Usage

### For Customers
1. **Browse Products**: View all available books on the homepage or products page
2. **Search & Filter**: Use search bar and price filters to find specific books
3. **User Account**: Register for an account to access cart functionality
4. **Shopping Cart**: Add books to cart, modify quantities, and proceed to checkout

### For Developers
- **Adding Products**: Modify the `$books` array in `includes/product-data.php`
- **Styling**: Customize appearance in `css/styles.css`
- **Functionality**: Extend features in `js/script.js`

## Key Technologies

- **Backend**: PHP 7.4+
- **Frontend**: HTML5, CSS3, JavaScript
- **Framework**: Bootstrap 5.3
- **Library**: jQuery 3.6
- **Icons**: Font Awesome 6.0
- **Data Storage**: JSON files (users), PHP arrays (products)

## API Endpoints

### Cart Management
- `POST /add-to-cart.php` - Add item to cart
- `POST /remove-from-cart.php` - Modify cart items

### Authentication
- `POST /auth/login.php` - User login
- `POST /auth/signup.php` - User registration
- `GET /auth/logout.php` - User logout

## Security Features

- Password hashing with PHP's `password_hash()`
- Session-based authentication
- CSRF protection through server-side validation
- Input sanitization and validation
- JSON response format for AJAX requests


## Future Enhancements

- Database integration (MySQL/PostgreSQL)
- Payment gateway integration
- Order management system
- Email notifications
- Product reviews and ratings
- Admin panel for product management
- Inventory tracking
- Advanced search filters

## Support

For technical support or feature requests, please contact the development team.

## License

This project is created for educational purposes. Feel free to modify and use for learning.