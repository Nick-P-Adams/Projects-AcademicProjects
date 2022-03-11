import java.io.File;
import java.io.FileNotFoundException;
import java.util.Scanner;

public class ModifiedBinarySearch 
{

	public static void main(String[] args) 
	{
		int x = Integer.parseInt(args[1]), y = Integer.parseInt(args[2]), count = 0;
		int[] array;
		File nf = new File(args[0]);
		
		try 
		{
			Scanner fb = new Scanner(nf);
			
			while(fb.hasNext())
			{
				fb.nextLine();
				count++;
			}
			
			array = new int[count];
			fb = new Scanner(nf);
			
			for(int i = 0; i < array.length; i++)
			{
				array[i] = Integer.parseInt(fb.nextLine());
				//System.out.println(array[i]);
			}
			
			if(array.length == 0 || x > y || y < array[0] || x > array[array.length -1])
			{
				System.out.println("null");
			}
			else if( x <= array[0] && y >= array[array.length - 1])
			{
				System.out.println("[0.." + (array.length - 1) + "]");
			}
			else
			{
				x = leftMost(array, x, y);
				y = rightMost(array, x, y);
				if(x == -1 || y == -1)
				{
					System.out.println("Does not exist");
				}
				else
				{
					System.out.println("[" + x + ".." + y + "]");
				}
			}
			
			
		}
		catch (FileNotFoundException e) 
		{
			System.out.println("File was not found");
		}
	}
	
	public static int leftMost(final int[] array, final int x, final int y)
	{
		int high = array.length - 1, low = 0;
		
		while(low <= high)
		{
			int mid = (int) Math.floor((low + (high))/2);
			
			if(array[mid] >= x)
			{
				if(mid == 0)
				{
					return mid;
				}
				if(array[mid - 1] < x)
				{
					return mid;
				}
				else if(array[mid - 1] >= x)
				{
					high = mid - 1;
				}
			}
			else if(array[mid] < x)
			{
				if(array[mid + 1] >= x)
				{
					return (mid + 1);
				}
				else if(array[mid + 1] < x)
				{
					low = mid + 2;
				}
			}
		}
		
		return -1;
	}
	
	public static int rightMost(final int[] array, final int x, final int y)
	{
		int high = array.length - 1, low = 0;
		
		while(low <= high)
		{
			int mid = (int) Math.floor((low + (high))/2);
			
			if(array[mid] <= y)
			{
				if(array[mid + 1] > y)
				{
					return mid;
				}
				else if(array[mid + 1] <= y)
				{
					low = mid + 2;
				}
			}
			else if(array[mid] > y)
			{
				if(mid == 0)
				{
					return mid;
				}
				
				if(array[mid - 1] <= y)
				{
					return (mid - 1);
				}
				else if(array[mid - 1] > y)
				{
					high = mid - 1;
				}
			}
		}
		
		return -1;
	}

}
