import java.io.File;
import java.io.IOException;

public class TopoSort 
{
	public static void main(String[] args) throws IOException 
	{
		File file = new File(args[0]);
		FileIO fileIO = new FileIO(file);
		AdjGraph graph = new AdjGraph(fileIO.getLineCount());
		LinkedList topoSortedGraph;
		
		while(!fileIO.EOF())
		{
			graph.insert(fileIO.nextLine());
		}
		
		//graph.printGraph();//remove comment lines if you want to see a print of the graph in adjacency list format 
		topoSortedGraph = graph.topologicalSortDFS(0);
		
		System.out.print("Graph Topologicaly Sorted: ");
		topoSortedGraph.printReverseList();
	}
}
