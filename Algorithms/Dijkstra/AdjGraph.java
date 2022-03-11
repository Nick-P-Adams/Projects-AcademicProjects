
public class AdjGraph 
{
	private LinkedList[] graph;
	private int vertCount = 0;
	
	public AdjGraph(int vertCount)
	{
		this.vertCount = vertCount;
		
		graph = new LinkedList[this.vertCount];
	}
	
	public void insert(String data)
	{
		String vertArray[] = data.split(":"), edgeArray[] = new String[0];
		
		try
		{
			LinkedList edgeList = new LinkedList();
			
			if(vertArray.length > 1)
			{
				if(vertArray[1].contains(";"))
				{
					vertArray[1] = vertArray[1].replace(";", ",");
				}
				edgeArray = vertArray[1].split(",");
			}
			
			if(edgeArray.length > 0)
			{
				for(int i = 0; i < edgeArray.length; i += 2)
				{
					edgeList.insert(Integer.parseInt(edgeArray[i]), Integer.parseInt(edgeArray[i+1]));
				}
				
				edgeList.setVertex(Integer.parseInt(vertArray[0]));
				graph[Integer.parseInt(vertArray[0])] = edgeList;
			}
			else if(vertArray.length > 0 && data.compareTo("") != 0)
			{
				edgeList.setVertex(Integer.parseInt(vertArray[0]));
				graph[Integer.parseInt(vertArray[0])] = edgeList;
			}
		}catch(ArrayIndexOutOfBoundsException e) {}
	}
	
	public LinkedList[] Dijkastra(int startingNode)
	{
		MinHeap workingVertices = new MinHeap(this.vertCount);
		LinkedList[] finishedVertices = new LinkedList[this.vertCount];
		
		this.graph[startingNode].setWeight(0);
		
		for(int i = 0; i < this.getVertCount(); i++)
		{
			workingVertices.insert(this.graph[i]);
		}
		
		while(workingVertices.getSize() != 0)
		{
			LinkedList curVertex = workingVertices.remove();
			finishedVertices[curVertex.getVertex()] = curVertex;
			
			for(int i = 0; i < curVertex.getSize(); i++)
			{
				if(this.graph[curVertex.get(i)].getWeight() > (curVertex.getWeight() + curVertex.getEdgeWeight(curVertex.get(i)))) 
				{
					this.graph[curVertex.get(i)].setWeight((curVertex.getWeight() + curVertex.getEdgeWeight(curVertex.get(i)))); 
					workingVertices.minHeap();
					this.graph[curVertex.get(i)].setParent(curVertex.getVertex());
				}
			}
		}
		
		return finishedVertices;
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
	
	public int getVertCount() {return this.vertCount;}
}
