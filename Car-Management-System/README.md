### **📌 Car Inventory Management System**
#### *A simple C program to manage a car inventory with search and filter features.*

---

## **📖 About the Project**
This **Car Inventory Management System** is a **C program** that allows users to:  
✅ **Add cars** to the inventory  
✅ **View all cars** with structured formatting  
✅ **Search cars** by brand  
✅ **Filter cars** based on price range  
✅ **Prevent invalid inputs** with input validation  

This project demonstrates **basic C programming concepts**, including:  
- **Structs** for managing car data  
- **Loops & conditionals** for user interaction  
- **Functions** for modular code design  
- **Input validation** to prevent errors  

---

## **🚀 How to Use**
### **1️⃣ Compile the Program**
First, ensure you have a **C compiler** (e.g., GCC).  
Run this command in your terminal:  
```sh
gcc main.c -o car_inventory
```

### **2️⃣ Run the Program**
After compilation, run the program:  
```sh
./car_inventory
```

### **3️⃣ Program Menu**
Once launched, you'll see this menu:  
```plaintext
===== Car Management System =====
1. Add Cars
2. View Car Inventory
3. Search by Brand
4. Filter by Price
5. Exit
Enter your choice:
```

#### **✅ Add Cars**
- Enter the number of cars you want to add.  
- Input details like **brand, model, CC, year, color, transmission, and price**.  
- If you enter a non-numeric value, the program **asks again without resetting**.  

#### **✅ View Car Inventory**
- Displays all stored cars in a **clean, structured format** like:  
  ```plaintext
  ----------------------------------------------------
  Car 1
  ----------------------------------------------------
  Brand: Toyota
  Model: Camry
  CC: 1800
  Year: 2022
  Color: Red
  Transmission: Automatic
  Sale Price: $20000
  ```

#### **✅ Search by Brand**
- Enter a brand name, and it will display **all matching cars**.  

#### **✅ Filter by Price**
- Choose from:  
  1️⃣ Below **$25,000**  
  2️⃣ Between **$25,000 and $50,000**  
  3️⃣ Above **$50,000**  
- It will list cars **within the selected price range**.  

#### **✅ Exit**
- Exits the program safely.  

---

## **💻 Features & Highlights**
✅ **Input validation** (Prevents crashes if the user enters wrong input)  
✅ **Looped menu system** (No need to restart after each action)  
✅ **Formatted output** (Easy-to-read car details)  
✅ **Efficient searching & filtering**  

---

## **📂 File Structure**
```
Car-Inventory-System/
│── main.c  # Main program file
│── README.md  # Documentation
```

---

## **🛠 Future Improvements**
🔹 Save & load inventory from a file  
🔹 Edit & delete cars from the inventory  
🔹 Improve UI with color-coded outputs  

---

## **📜 License**
This project is **open-source** and free to use. Feel free to modify or contribute!  

---

## **👤 Author**
- **ghostuser-bug** 
- **GitHub:** https://github.com/ghostuser-bug

---
