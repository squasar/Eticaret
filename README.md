# Eticaret

A PHP-based bookstore / e-commerce web application prototype.

This project implements the core flow of a simple online book store, including:

- customer registration and login
- category-based product browsing
- book detail viewing
- shopping cart management
- order modeling and checkout-oriented flow
- MySQL-backed persistence
- reusable helper / model / controller structure

It is best understood as an early structured web application project rather than a production-ready commerce platform.

## Project overview

`Eticaret` is a book-selling site built with PHP and MySQL.  
The project includes both public and logged-in user flows and focuses on modeling the core behavior of a small e-commerce system.

The domain includes:

- **customers**
- **admins**
- **categories**
- **books**
- **orders**
- **messages**
- **comments**

## What the project does

The codebase supports:

- user registration
- user authentication
- category listing
- category-based book retrieval
- product detail flow
- cart add/update/remove behavior
- order grouping and status management
- basic page rendering for anonymous and authenticated users

## Main technologies

- **PHP**
- **MySQL / mysqli**
- **session-based authentication**
- **server-rendered views**
- **custom autoloading**
- **object-oriented domain modeling**

## Architecture direction

One of the most interesting parts of this repository is that it is not purely procedural PHP.

The project shows a clear move toward a more structured architecture:

- `controllers/` for request handling and flow
- `models/classes/` for domain entities
- `models/helpers/` for helper/service-style wrappers
- autoloaders for organizing class loading
- page/view abstractions through `page.inc`

That makes the repository more meaningful than a basic PHP assignment.

## Important modules

### Customer flow
The project includes customer registration and login handling through customer-related classes and helpers.

### Product and category flow
Books are modeled as products linked to categories, with retrieval methods for:
- all books
- books by category
- books by title
- books by author
- books by ISBN

### Cart and order flow
A substantial part of the project is dedicated to shopping cart and order behavior:
- adding items to cart
- updating quantities
- removing items
- calculating totals
- grouping cart items into order structures
- managing order states such as pending, paid, shipped, and delivered

### Database layer
The project includes a small custom database abstraction using:
- `MySQLConnect`
- `MySQLQueries`

This separates connection/query concerns from higher-level business objects.

### UI/page layer
The project also includes page abstractions and view files for:
- homepage
- logged-in pages
- cart display
- product detail display
- account-related navigation

## What is meaningful here

This repo is meaningful because it shows more than “I made a few PHP pages.”

It shows attempts to model a real application:

- domain entities
- reusable helpers
- shopping cart logic
- order lifecycle
- session-driven user flow
- refactoring toward a cleaner structure

In other words, it shows early backend/full-stack design thinking, not just raw PHP scripting.

## Limitations

- The application is unfinished in places.
- Some classes and methods are stubs.
- Security practices are basic and would need significant improvement.
- Some flow design is brittle or overly manual.
- There are rough edges in naming, routing, and separation of concerns.
- Debug-style code and transitional refactor patterns are still visible.

## Best way to interpret this repository

This is best presented as:

**an early object-oriented PHP e-commerce/bookstore prototype**  
that demonstrates practical web development and an effort to move from procedural code toward a more organized architecture.

## Future improvements

- move configuration and database credentials out of source files
- improve authentication and password handling
- clean up routing and redirects
- complete missing admin/message/comment functionality
- add database schema/setup documentation
- improve naming consistency
- document all user flows clearly
- separate presentation, business logic, and persistence more rigorously

## Summary

`Eticaret` is an early but meaningful bookstore/e-commerce project built with PHP and MySQL.

It demonstrates:
- registration/login flow
- product/category modeling
- shopping cart and order logic
- custom database abstraction
- attempts at modular architecture and code organization

It is valuable as evidence of practical full-stack growth and early software design effort.
