package findingRichest;

import java.io.File;
import java.io.FileWriter;
import java.io.IOException;
import java.util.ArrayList;
import java.util.Scanner;

public class Richest 
{

	public static void main(String[] args) 
	{
		try 
		{
			File file = new File(args[0]);
			FileWriter output = new FileWriter(new File("richest.output"));
			Scanner fs = new Scanner(file);
			MinHeap heap = new MinHeap(10000);
			int count = 0;
			
			while(fs.hasNext() && count <= 10000)
			{
				heap.insert(fs.nextInt());
				count++;
			}
			heap.minHeap();
			
			ArrayList<Integer> fileBuffer = new ArrayList<Integer>();
			
			while(heap.getSize() > 0)
			{
				fileBuffer.add(heap.remove());
			}
			
			for(int i = fileBuffer.size() - 1; i >= 0; i--)
			{
				output.write(fileBuffer.get(i) + "\n");
			}
			output.close();
			fs.close();
		} 
		catch (IOException e) 
		{
			e.printStackTrace();
		}
		
		
	
		
	
	}

}
