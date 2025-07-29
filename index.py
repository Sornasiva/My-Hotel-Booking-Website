def show_menu():
    print("----- To-Do List -----")
    print("1. View Task")
    print("2. Add Task")
    print("3. Delete Task")
    print("4. Exit")

def view_task():
    try:
        with open("siva.txt","r") as file:
            tasks = file.readlines()
            if not tasks:
                print("\n Tasks not found.")
            else:
                print("\nYour Tasks...")
                for id , task in enumerate(tasks,start=1):
                    print(f"{id}.{task.strip()}")
    except FileNotFoundError:
        print("\n Not Task Found")

def add_task():
    task = input("Enter the Task : ")
    with open("siva.txt","a") as file:
        file.write(task + "\n")
    print("Task Added Successfully")

def delete_task():
    try:
        with open("siva.txt","r") as file:
            tasks = file.readlines()
            if not tasks:
                print("\n Tasks not Deleted.")
                return view_task()
            task_num = int(input("\nEnter task number to delete : "))
            if 1 <= task_num <= len(tasks):
                del tasks[task_num - 1]
                with open("siva.txt","w") as file:
                    file.writelines(tasks)
                print("\n Task Deleted Successfully")
            else:
                print("Invalid Task Number.")
    except FileNotFoundError:
        print("\n Not Task Found")

#main loop start
while True:
    show_menu()
    choice = input("Enter the Choice (1 to 4): ")

    if choice == '1':
        view_task()
    elif choice == '2':
        add_task()
    elif choice == '3':
        delete_task()
    elif choice == '4':
        print("Existing To-DO List. GoodBye!..")
        break
    else:
        print("Invalid choice. Please try Again.")

