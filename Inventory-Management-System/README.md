# **📌 Car Inventory Management System**
#### *A simple C program to manage a car inventory with search and filter features. While this program design for car inventory but its also can be used for other inventory as well such as supermarket, mall, store and other items as well.*

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

## **🚨 Program Inefficiency & Revamp Plan**
While this program works, it has a **major inefficiency**:  

❌ **Manually inputting car details one by one is slow** and not practical for large inventories.  

### **🔹 Future Revamped Version**
To solve this, a **revamped version** of this program will:  
✅ **Read car details from files instead of manual entry**  
✅ **Support Excel (`.csv`), TXT (`.txt`), and Word (`.docx`) file formats**  
✅ **Automatically process multiple car entries at once**  

This improvement will make the program **faster, scalable, and more user-friendly**.

---

## **🚀 How to Use**
### **1️⃣ Compile the Program**
Ensure you have a **C compiler** (e.g., GCC).  
Run this command in your terminal:  
```sh
gcc main.c -o main
```

### **2️⃣ Run the Program**
After compilation, run the program:  
```sh
./main
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
🚀 **Revamped version will include:**  
🔹 **File reading support** (`Excel, TXT, Word`) instead of manual entry  
🔹 **Save/load inventory to/from a file**  
🔹 **Edit & delete cars from the inventory**  
🔹 **Better error handling & UI improvements**  

---

## **📜 License**
This project is **open-source** and free to use. Feel free to modify or contribute!  

---

## **👤 Author**
- **Your Name** ghostuser-bug 
- **GitHub:** https://github.com/ghostuser-bug/
