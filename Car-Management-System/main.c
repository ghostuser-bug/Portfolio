#include <stdio.h>
#include <string.h>
#define p printf
#define s scanf

struct Car {
    char brand[20];
    char model[20];
    int cc;
    int year;
    char color[10];
    char transmissionType[6];
    double salePrice;
};

void displayCars(struct Car cars[], int numCars);
void searchByBrand(struct Car cars[], int numCars);
void filterByPrice(struct Car cars[], int numCars);

int main() {
    struct Car usedCars[50];
    int numCars = 0;
    int choice;

    while (1) {
        p("\n===== Car Management System =====\n");
        p("1. Add Cars\n");
        p("2. View Car Inventory\n");
        p("3. Search by Brand\n");
        p("4. Filter by Price\n");
        p("5. Exit\n");
        p("Enter your choice: ");

        if (s("%d", &choice) != 1) {
            p("⚠️ Invalid input! Please enter a number.\n");
            while (getchar() != '\n');
            continue;
        }

        if (choice == 1) {
            while (1) {
                p("\nEnter the number of cars to add: ");
                if (s("%d", &numCars) == 1 && numCars > 0) {
                    break;
                }
                p("⚠️ Invalid input! Please enter a valid number.\n");
                while (getchar() != '\n');
            }

            for (int i = 0; i < numCars; i++) {
                p("\n===== Enter details for Car %d =====\n", i + 1);
                p("Enter the brand: ");
                s("%s", usedCars[i].brand);
                p("Enter the model: ");
                s("%s", usedCars[i].model);
                p("Enter the CC: ");
                s("%d", &usedCars[i].cc);
                p("Enter the year: ");
                s("%d", &usedCars[i].year);
                p("Enter the color: ");
                s("%s", usedCars[i].color);
                p("Enter the transmission type: ");
                s("%s", usedCars[i].transmissionType);
                p("Enter the sale price without currency: ");
                s("%lf", &usedCars[i].salePrice);
            }
        } else if (choice == 2) {
            displayCars(usedCars, numCars);
        } else if (choice == 3) {
            searchByBrand(usedCars, numCars);
        } else if (choice == 4) {
            filterByPrice(usedCars, numCars);
        } else if (choice == 5) {
            p("Exiting program...\n");
            break;
        } else {
            p("⚠️ Invalid choice. Please enter a number between 1-5.\n");
        }
    }

    return 0;
}

void displayCars(struct Car cars[], int numCars) {
    if (numCars == 0) {
        p("\nNo cars in inventory.\n");
        return;
    }

    p("\n===== List of cars available =====\n");
    for (int i = 0; i < numCars; i++) {
        p("\n----------------------------------------------------\n");
        p("Car %d\n", i + 1);
        p("----------------------------------------------------\n");
        p("Brand: %s\n", cars[i].brand);
        p("Model: %s\n", cars[i].model);
        p("CC: %d\n", cars[i].cc);
        p("Year: %d\n", cars[i].year);
        p("Color: %s\n", cars[i].color);
        p("Transmission: %s\n", cars[i].transmissionType);

        if (cars[i].salePrice == (int)cars[i].salePrice) {
            p("Sale Price: $%d\n", (int)cars[i].salePrice);
        } else {
            p("Sale Price: $%.2lf\n", cars[i].salePrice);
        }
    }
}

void searchByBrand(struct Car cars[], int numCars) {
    char brandSearch[20];
    int found = 0;

    p("\nEnter the brand to search for: ");
    s("%s", brandSearch);

    p("\n===== Cars Matching Brand: %s =====\n", brandSearch);
    for (int i = 0; i < numCars; i++) {
        if (strcmp(cars[i].brand, brandSearch) == 0) {
            p("\n----------------------------------------------------\n");
            p("Brand: %s\n", cars[i].brand);
            p("Model: %s\n", cars[i].model);
            p("CC: %d\n", cars[i].cc);
            p("Year: %d\n", cars[i].year);
            p("Color: %s\n", cars[i].color);
            p("Transmission: %s\n", cars[i].transmissionType);

            if (cars[i].salePrice == (int)cars[i].salePrice) {
                p("Sale Price: $%d\n", (int)cars[i].salePrice);
            } else {
                p("Sale Price: $%.2lf\n", cars[i].salePrice);
            }
            found = 1;
        }
    }

    if (!found) {
        p("No cars found with the brand '%s'.\n", brandSearch);
    }
}

void filterByPrice(struct Car cars[], int numCars) {
    int choice;
    
    p("\nChoose price filter:\n");
    p("1. Below $25,000\n");
    p("2. Between $25,000 and $50,000\n");
    p("3. Above $50,000\n");

    while (1) {
        p("Enter your choice: ");
        if (s("%d", &choice) == 1 && choice >= 1 && choice <= 3) {
            break;
        }
        p("⚠️ Invalid input! Please enter a valid option (1-3).\n");
        while (getchar() != '\n');
    }

    p("\n===== Cars Matching Price Range =====\n");
    for (int i = 0; i < numCars; i++) {
        if ((choice == 1 && cars[i].salePrice < 25000) ||
            (choice == 2 && cars[i].salePrice >= 25000 && cars[i].salePrice <= 50000) ||
            (choice == 3 && cars[i].salePrice > 50000)) {
            p("\n----------------------------------------------------\n");
            p("Brand: %s\n", cars[i].brand);
            p("Model: %s\n", cars[i].model);
            p("CC: %d\n", cars[i].cc);
            p("Year: %d\n", cars[i].year);
            p("Color: %s\n", cars[i].color);
            p("Transmission: %s\n", cars[i].transmissionType);

            if (cars[i].salePrice == (int)cars[i].salePrice) {
                p("Sale Price: $%d\n", (int)cars[i].salePrice);
            } else {
                p("Sale Price: $%.2lf\n", cars[i].salePrice);
            }
        }
    }
}
