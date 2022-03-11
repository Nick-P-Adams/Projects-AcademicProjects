import java.io.File;
import java.io.FileNotFoundException;
import java.util.Random;
import java.util.Scanner;

public class OS_Finding 
{
	public static void main(String[] args) 
	{
		int[] A;
		int or, i = Integer.parseInt(args[1]);
		File file = new File(args[0]);
		OS_Finding osfo = new OS_Finding();
		
		A = osfo.fileToArray(file);
		
		if(A != null && A.length != 0)
		{
			if(i > 0 && i <= A.length)
			{
				or = osfo.randomizedSelect(A, 0, (A.length - 1), i);
				if(i == 1) 
				{
					System.out.println("The "+ i + "st order statistic is: " + or);
				}
				else if(i == 2)
				{
					System.out.println("The "+ i + "nd order statistic is: " + or);
				}
				else if(i == 3)
				{
					System.out.println("The "+ i + "rd order statistic is: " + or);
				}
				else
				{
					System.out.println("The "+ i + "th order statistic is: " + or);
				}
			}
			else
			{
				System.out.println("There is no statistic of that order in this array.");
			}
		}
		else
		{
			System.out.println("Null or Empty");
		}
		
		
	}
	
	private void swap(int[] A, final int v1, final int v2)
	{
		int temp = A[v1];
		A[v1] = A[v2];
		A[v2] = temp;
	}
	
	private int partition(int[] A, final int left, final int right)
	{
		int pivot = A[right];
		int index = left;
		
		for(int i = left; i <= (right - 1); i++)
		{
			if(A[i] <= pivot)
			{
				swap(A, index, i);
				
				index++;
			}
		}
		swap(A, index, right);

		return index;
	}
	
	private int randomizedPartition(int[] A, final int left, final int right)
	{
		Random rand = new Random();
		int i = left + rand.nextInt(right - left);
		
		swap(A, i, right);
		
		return partition(A, left, right);
	}
	
	private int randomizedSelect(int[] A, int p, int r, int i)
	{
		if(p == r)
		{
			return A[p];
		}
		
		int q = randomizedPartition(A, p, r);
		int k = q - p + 1;
		
		if(i == k)
		{
			return A[q];
		}
		else if(i < k)
		{
			return randomizedSelect(A, p, (q - 1), i);
		}
		else 
		{
			return randomizedSelect(A, (q + 1), r, (i - k));
		}
	}
	
	private int[] fileToArray(File file) 
	{
		Scanner inf;
		int count = 0;
		int[] A;
		
		try 
		{
			inf = new Scanner(file);
			
			while(inf.hasNext())
			{
				inf.nextLine();
				count++;
			}
			
			A = new int[count];
			inf = new Scanner(file);
			
			for(int i = 0; i < A.length; i++)
			{
				A[i] = Integer.parseInt(inf.nextLine());
			}
			
			return A;
		} 
		catch (FileNotFoundException e) 
		{
			System.out.println("File Not Found Error: " + e.getMessage());
			return null;
		}
	}
}
