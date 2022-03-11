import java.io.File;
import java.io.FileNotFoundException;
import java.util.Scanner;

public class QuickSort 
{
	public static void main(String[] args) throws FileNotFoundException 
	{
		File file = new File(args[0]);
		Scanner inf = new Scanner(file);
		DLinkedList list = new DLinkedList();
		
		while(inf.hasNext())
		{
			list.addLast(inf.next());
		}
		list.quickSort(list.getFirst(), list.getLast());
		list.printList();
	}
}
