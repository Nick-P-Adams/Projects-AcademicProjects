import java.io.File;
import java.io.IOException;
import java.lang.StringBuilder;

public class Dijkstra 
{
	public static void main(String[] args) throws IOException 
	{
		File file = new File(args[0]);
		FileIO fileIO = new FileIO(file);
		AdjGraph graph = new AdjGraph(fileIO.getLineCount());
		int startingNode = Integer.parseInt(args[1]);
		
		while(!fileIO.EOF())
		{
			graph.insert(fileIO.nextLine());
		}
		
		LinkedList[] results = graph.Dijkastra(startingNode);
		
		//graph.printGraph();

		for(int i = 0; i < graph.getVertCount(); i++)
		{
			String shortestPath = "";
			if(results[i].getParent() == -1)
			{
				if(startingNode != i)
				{
					System.out.println("[" + i + "]" + " Unreachable");
				}	
			}
			else
			{
				int parent = results[i].getVertex();
				while(parent != -1)
				{
					shortestPath += " " + parent;
					parent = results[parent].getParent();
				}
				shortestPath = "(" + new StringBuilder(shortestPath).reverse().toString() + ") ";
				System.out.println("[" + i + "]" + " Shortest path: " + shortestPath + "shortest distance: " + results[i].getWeight());
			}
		}
	}
}
