
public class AdjGraph 
{
	private LinkedList[] graph;
	private int vertCount = 0;
	LinkedList topoSortedDFS = new LinkedList();
	
	public AdjGraph(int vertCount)
	{
		this.vertCount = vertCount;
		
		graph = new LinkedList[this.vertCount];
	}
	
	public LinkedList topologicalSortDFS(int v)
	{
		return graphDFS(v);
	}
	
	private LinkedList graphDFS(int v)
	{
		this.graph[v].setVisited(true);
		//System.out.print(v + " ");//remove comment lines if you want to print result of DFS
		
		for(int i = 0; i < graph[v].getSize(); i++)
		{
			int u = graph[v].get(i);
			
			if(!graph[u].visited())
			{
				graphDFS(u);
			}
		}
		topoSortedDFS.insert(v);
		
		return topoSortedDFS;
	}
	
	public void insert(String data)
	{
		String vertArray[] = data.split(":");
		String edgeArray[] = new String[0];
		
		try
		{
			LinkedList edgeList = new LinkedList();
			
			if(vertArray.length > 1)
			{
				edgeArray = vertArray[1].split(",");
			}
			
			if(edgeArray.length > 0)
			{
				for(int i = 0; i < edgeArray.length; i++)
				{
					edgeList.insert(Integer.parseInt(edgeArray[i]));
				}
				
				graph[Integer.parseInt(vertArray[0])] = edgeList;
			}
			else if(vertArray.length > 0 && data.compareTo("") != 0)
			{
				graph[Integer.parseInt(vertArray[0])] = edgeList;
			}
		}catch(ArrayIndexOutOfBoundsException e) {}
	}
	
	public void printGraph()
	{
		for(int i = 0; i < this.graph.length; i++)
		{
			if(this.graph[i].getSize() != 0)
			{
				System.out.print("Vert: " + i + " Children: ");
				this.graph[i].printList();
			}
			else
			{
				System.out.print("Vert: " + i + " Children: None");
			}
			System.out.print("\n");
		}
	}
}
