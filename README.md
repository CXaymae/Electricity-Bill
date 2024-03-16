# Web Application for Electricity Bill Management

This project is carried out as part of TP-2 at Abdelmalek Essaâdi University, School of Applied Sciences in Tétouan. The aim of this web application is to enable electricity provider customers to enter and view their bills.

## Basic Features

### For Customers
1. Enter electricity consumption at the end of each month and upload a photo of the meter.
2. View electricity bills.
3. Make a complaint specifying the type of complaint:
   - External leak
   - Internal leak
   - Bill issue
   - Other (to be specified)

### For the Provider
1. Manage customers (addition/modification of customer information).
2. Handle complaints and notify customers.
3. Handle anomalies in customer entries per month:
   - If no anomalies, the bill is generated automatically. Each bill must contain customer information (name, surname, address, ...), consumption, and price (pre-tax and including tax) as well as the meter photo.
   - Otherwise, a modification of the entered consumption is necessary before generating the bill.

## Additional Details
- VAT: 14%
- Unit price per month based on consumption:
  - Between 0 and 100 KWH: 0.8 DH
  - Between 101 and 200 KWH: 0.9 DH
  - More than 201 KWH: 1.0 DH
- At the end of each year, an agent submits the `Annual_Consumption.txt` file containing the annual consumption of each customer (collected during the agent's tour). This tour is conducted once a year. The insertion of this consumption must be automatic.
- Structure of the `Annual_Consumption.txt` file: ID_Client, Consumption, "< Year >", Date_Recorded
- Addition of a page to display some summary information (Dashboard) on the amount of unpaid bills, monthly consumption, etc.
- The provider verifies at the end of each year the information (regarding electricity consumption) entered by the customers. For annual consumption, a difference of 50 KWh between the consumption entered by the customer and that entered by the agent is tolerated.

## Authors
- CHAIRI Chaimae
- Supervised by: Prof. ALACHHAB
