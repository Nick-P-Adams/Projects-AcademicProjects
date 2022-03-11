
public class LinkedList 
{
	private Node head = null;
	private int vertex, parent = -1, size = 0, weight = 2000000000;
	
	private class Node
	{
		int data, weight;
		Node next;
		
		Node(int data)
		{
			this.data = data;
			this.next = null;
		}
	}
	
	public void insert(int data, int weight)
	{
		Node nn = new Node(data);
		nn.weight = weight;
		
		if(this.head == null)
		{
			this.head = nn;
		}
		else
		{
			Node last = this.head;
			
			while(last.next != null)
			{
				last = last.next;
			}
			
			last.next = nn;
		}
		
		this.size++;
	}
	
	public int get(int index)
	{
		Node cur = this.head;
		int count = 0;
		
		while(cur != null)
		{
			if(count == index)
			{
				return cur.data;
			}
			
			count++;
			cur = cur.next;
		}
		
		return 0;
	}
	
	public int getEdgeWeight(int node)
	{
		Node cur = this.head;
		
		while(cur != null)
		{
			if(cur.data == node)
			{
				return cur.weight;
			}
			
			cur = cur.next;
		}
		
		return 0;
	}
	
	public void printList()
	{
		Node cur = this.head;
		while(cur != null)
		{
			System.out.print(cur.data + " (EW=" + cur.weight + "), ");//EW is edge weight from current vert to it's child
			cur = cur.next;
		}
	}
	
	public void printReverseList()
	{
		Node cur = this.head;
		this.printReverseUtil(cur);
	}
	
	private void printReverseUtil(Node cur)
	{
		if(cur.next != null)
		{
			printReverseUtil(cur.next);
		}
		System.out.print(cur.data + " ");
	}
	
	public int getSize() {return this.size;}
	public void setWeight(int weight) {this.weight = weight;}
	public int getWeight() {return this.weight;}
	public void setVertex(int vertex) {this.vertex = vertex;}
	public int getVertex() {return this.vertex;}
	public void setParent(int parent) {this.parent = parent;}
	public int getParent() {return this.parent;}
}

